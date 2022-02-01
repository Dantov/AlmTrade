<?php

namespace dtw\db;

/*
 * класс для реализует методы для поиска по БД
 */
use dtw\Obj;

class Finder extends Base
{

    /*
     * @var array $withTables - массив таблиц связей, заполняется методом width('table1','table2','table3')
     * Нужен для поиска
     */
    private $withTables;
    /*
     * @var string - строка полей для поиска //field1,field2,field3
     */
    private $columns = '*';
    /*
     * @var string - option LIMIT
     */
    private $limit = '';
    /*
     * @var string - option ORDER BY
     */
    private $orderby = '';
    /*
     * @var string - option WHERE
     */
    private $where = '';

    /*
     * для findOne
     */
    private $one = false;

    public function __construct($tableName, $tableRelations)
    {
        parent::__construct($tableName, $tableRelations);
    }

    public function count()
    {
        $query = "SELECT $this->primaryKey FROM $this->tableName";
        $count = $this->query($query);
        //debug($count,'$res',1);
        return $count->num_rows;
    }

    public function findBySQL($query,$params=[])
    {
        if ( !is_string($query) || empty($query) ) return "Query must be no empty string.";
        //$params

        return $this->query($query);
    }
    /*
     * @param array $columns
     * принимает массив полей которые хотим найти
     * формирует строку из этих полей
     * return $this; указатель на этот объект
     */
    public function findAll( $columns=[] )
    {
        $columnsStr = '';
        if ( !empty($columns) ) {
            foreach ( $columns as $clmn ) {
                $columnsStr .= $clmn.',';
            }
            $this->columns = trim($columnsStr,',');
        }
        return $this;
    }
    /*
     * @param array $columns
     * найдем первую попавшуюся
     */
    public function findOne($columns=[])
    {
        $this->one = true;
        $this->limit(1);
        return $this->findAll($columns);
    }

    /*
     * принимает параметры в виде массивов where(['name','like','aa'],['id','=','23'],[...])
     * заполняет строку WHERE, если пришло больше одного параметра
     * дополняет строку через AND
     * return $this; указатель на этот объект
     */
    public function where() {

        $arg_list = func_get_args();

        $whereStr = '';
        $where = 'WHERE ';

        for ($i = 0; $i < func_num_args(); $i++) {

            if ( is_array($arg_list[$i]) ) {
                if ($i > 0) $where = ' AND ';
                $where_clmn = $this->MySQLi->real_escape_string(strtolower($arg_list[$i][0]));
                $where_oper = $this->MySQLi->real_escape_string(strtolower($arg_list[$i][1]));
                $where_val = $this->MySQLi->real_escape_string(strtolower($arg_list[$i][2]));

                if ($where_oper === 'like') $where_val = '%' . $where_val . '%';
                $whereStr .= $where . $where_clmn . " " . $where_oper . " '$where_val'";
            }
        }
        $this->where = $whereStr;

        return $this;
    }

    public function andWhere()
    {

    }
    public function orWhere()
    {

    }

    public function orderBy($field) {

        if ( !empty($field) ) {
            $value = $this->MySQLi->real_escape_string($field);
            $this->orderby = "ORDER BY $value";
        }

        return $this;
    }

    public function limit($num, $offset = 0)
    {
        $value = (int)$num;
        if ( $value > 0  )
        {
            $this->limit = "LIMIT $value";
        }

        $offset = (int)$offset;
        if ( !empty($offset) && is_int($offset) )
        {
            $billion2 = 1999999999;
            $offset = $offset < $billion2 ? $offset : $billion2;
            $this->limit = "LIMIT $offset, $value";
        }

        return $this;
    }

    /*
     * принимает строки, названия таблиц
     * связывает выборку из метода go() с этими таблицами
     * return $this; указатель на этот объект
     */
    public function with() {

        // если связываем др. табл - добавим primaryKey к выборке.
        $pkStr = $this->primaryKey.',';
        $this->columns .= "," . trim($pkStr,',');

        // без аргументов - берем список всех таблиц из $this->tableRelations
        if ( func_num_args() === 0 )
        {
            $this->withTables = $this->tableRelations;
            return $this;
        }

        // можно передавать список таблиц в виде массива
        // ['table1','table2','table3']
        $arg_list = func_get_args();

        if ( is_array($arg_list[0]) && !empty($arg_list[0]) )
        {
            $arg_list = array_flip($arg_list[0]);
            foreach ( $arg_list as $key => $val )
            {
                if ( array_key_exists($key, $this->tableRelations) )
                {
                    $this->withTables[$key] = $this->tableRelations[$key];
                }
            }
            return $this;
        }

        // или просто аргументы через запятую
        // 'table1','table2','table3'
        for ($i = 0; $i < func_num_args(); $i++)
        {
            if ( array_key_exists($arg_list[$i], $this->tableRelations) )
            {
                $this->withTables[$arg_list[$i]] = $this->tableRelations[$arg_list[$i]];
            }
        }

        return $this;
    }

    /*
     * финальный метод выборки
     * return @var array - многомерный массив. результат выборки из бд
     */
    public function go()
    {
        $result = [];
        if ( !DataBase::isConnected() ) return $result['error'] = 'No DB connection!';

        $queryTables = [];
        // строка с primKey вида '22','21','67' - список найденных айдишников
        $primKeysStr = '';

        // делаем выборку из главной таблицы
        $query = " SELECT $this->columns FROM $this->tableName $this->where $this->orderby $this->limit";
        //debug($query,'$query');
        $resQuery = $this->query($query);

        $pk = $this->primaryKey;

        if ( $resQuery ) {
            while ($obj = $resQuery->fetch_object()) {

                $result[] = new Obj($obj); //основные данные
                // список ключей для связи с другими табл.
				 //if ( empty($obj->$pk) ) continue;
                $primKeysStr .= "'".$obj->$pk."',";
            }
            $primKeysStr = trim($primKeysStr,',');
            $resQuery->close();
        } else {
            $result['MYSQL_error'] = $this->MySQLi->error;
            $result['MYSQL_errno'] = $this->MySQLi->errno;
            return $result;
        }

        //debug($result,'$result');
        // если ничего не нашли в основной выборке то выбирать из связанных таблицы нет смысла!
        if ( empty($primKeysStr) ) return [];

        // добираем данные из связанных таблиц. Если они есть.
        // IN - поиск в диапазоне $primKeysStr
        if ( is_array($this->withTables) ) {
            foreach ($this->withTables as $table => $column) {

                $query = "SELECT * FROM $table WHERE $column IN ($primKeysStr)";
                $res = $this->query($query);
                if ($res) {
                    while ($obj = $res->fetch_object()) {

                        $queryTables[$table][] = $obj;
                    }
                    $res->close();
                } else {
                    $result['MYSQL_error'] = $this->MySQLi->error;
                    $result['MYSQL_errno'] = $this->MySQLi->errno;
                    return $result;
                }

            }
            // $queryTables - теперь объект. Имена таблиц теперь его св-ва.
            // которые содержат массив с цифровыми ключами
            $queryTables = new Obj($queryTables);
            //debug($queryTables,'$queryTables');
        }


        // формируем единый массив всех выбранных данных
        for ( $i = 0; $i < count($result); $i++ ) {
            $id = $result[$i]->$pk;
            foreach (  $queryTables as $table => $records )  {
                //$tbl = 'tbl_'.$table;
                $tbl = $table;
                $result[$i]->$tbl = [];
                foreach (  $records as $key => $val )
                {
                     //условие необходимо что бы взять только принадлежащие к этой таблице данные
                    $par_Id = $this->withTables[$table];
                    if ($val->$par_Id === $id ) {
                        array_push($result[$i]->$tbl, $val);
                    }
                }
            }
        }

        // если поиск был инициирован методом findOne() - вернем только первый найденый объект
        if ( $this->one ) {
            $result = $result[0];
            $this->one = false;
        }

        return LoadedData::$LoadedData = $result;
        //return $result;
    }

}