<?php

namespace dtw\db;

/*
 * создается для каждой конкретной таблицы
 */

use dtw\Obj;
use dtw\Validator;

class Record extends Base
{
    /* =============== свойства для связанных таблиц ===================*/

    /*
     * @var object $field
     * содержит имена таблиц и всех столбцов в них.
     * Типа:
     *  loadedData->id
     *  loadedData->name
     *  loadedData->age
     *  loadedData->tbl_files => [
            [id] => null
            [name] => null
            [notice] => null
        ]
         loadedData->tbl_repairs => [
                [id] => null
                [name] => null
                [descr] => null
                [date] => null
            ]
     * это св-во будет заполнено данными методом load()
     */
    protected $loadedData;

    /*
     * специальный флаг true|false
     * указывает была ли произведена загрузка данных в свойство $loadedData
     * по средством методов load() и loadFromFinder()
     * это нужно что бы инициировать загрузку данных методом insert(), если $this->loadedData пуст
     * данные будут взяты из объекта LoadedData::$loadedData - внесенные туда методами findAll() или findOne()
     */
    protected $alreadyLoaded = false;


    /* ================== методы =================== */
    public function __set( $name, $value )
    {
        return 'undefined property - ' . $name;
    }
    public function __get( $name )
    {
        return "property '$name' does not exist";
    }
    public function __isset($name)
    {
        return isset($this->$name);
    }

    public function __construct($tableName, $tableRelations)
    {
        parent::__construct($tableName, $tableRelations);

        $this->loadedData = new Obj([]);
    }


    /*
     * @var array|object $data
     * загружаем данные в эту табл из формы
     * return object $this->loadedData
     */
    public function load($data)
    {
        if ( !(is_array($data) || is_object($data)) ) return false;

        $pk = $this->primaryKey;
        foreach ( $data as $table => $fields )
        {
            // $fields - массив полей

            if ( $table == $this->tableName )
            {
                //если имя в форме соотв. имени текущей табл. то $this->loadedData заполним полями
                foreach ( $fields as $field => $value )
                {
                    $this->loadedData->$field = $value;
                }
                if ( !empty($this->loadedData->$pk) ) $this->primaryKeyVal = (int)$this->loadedData->$pk;
                continue;
            } else { //иначе создадим доп поле по имени табл.

                //заполним остальные поля в соотв. с $this->tableRelationsSchema
                if ( array_key_exists($table, $this->tableRelationsSchema) )
                {
                    $this->loadedData->$table = new Obj($fields);
                }

            }
        }

        // установим флаг что данные загружены
        $this->alreadyLoaded = true;

        return $this->loadedData;
    }
    /*
     * загружает данные из поиска от функций findAll findOne
     */
    public function loadFromFinder($data)
    {
        if ( !(is_array($data) || is_object($data)) || empty($data) ) return [];

        $this->loadedData = [];
        function flipLoop($object, $tableRelationsSchema)
        {
            foreach ( $object as $field => $value )
            {
                if ( array_key_exists($field, $tableRelationsSchema) )
                {
                    $flippedObject = new Obj([]);
                    foreach ( $value as $key => $obj )
                    {
                        //debug($object,'$object');
                        foreach ( $obj as $prop => $val )
                        {
                            if ( !is_array($flippedObject->$prop) ) $flippedObject->$prop = [];
                            array_push($flippedObject->$prop, $val);
                        }
                    }
                    $object->$field = $flippedObject;
                }
            }
            return $object;
        }

        // если первый ключ = число, значит из поиска нам пришло много строк, возможно с связанными табл.
        if ( is_int( array_key_first($data) ) )
        {
            for ( $i = 0; $i < count($data); $i++ )
            {
                $this->loadedData[$i] = flipLoop(clone $data[$i], $this->tableRelationsSchema);
            }

        } else {
            $this->loadedData = flipLoop( clone $data, $this->tableRelationsSchema);
        }

        $this->alreadyLoaded = true;

        return $this->loadedData;
    }


    /*
     * @var string $tableName
     * вычленяет данные для указанной табл
     * return object
     */
    public function loadedDataExecute($tableName, $data='')
    {
        $eprst = $this->loadedData;
        if ( is_object($data) ) $eprst = $data;

        if ( !empty($eprst->$tableName) )
        {
            return $eprst->$tableName;

        } elseif ( $tableName == $this->tableName ) {

            $result = new Obj([]);
            foreach ( $eprst as $column => $value )
            {
                if ( !array_key_exists($column, $this->field) ) continue; // если в таблице нет такого поля - уходим
                if ( empty($value) ) continue;  // уходим на пустом знач

                $result->$column = $value;
            }
            return $result;
        }
        return [];
    }
    /*
     * @var bool $with
     * false - вставляет только данные текущей табл $this->tableName
     * true - вставляет данные всех таблиц
     * array - список переданных таблиц
     *
     * @var array $tables
     * список табл. с которыми будем работать
     *
     * добавляет новую запись в таблицу из объекта $this->loadedData
     *
     * ВНИМАНИЕ!!
     * Если хочешь вставить несколько строк сразу. Типа
     * [0 => 'value1', 1=> 'value2'] и т.д.
     * то позаботься что-бы во всех полях были массивы одинаковой длинны
     * хотя бы с пустыми значениями!!!
     *
     * вернет insert_id при успехе, sql ошибку при неудаче, или false если нечего было вставлять
     * return insert_id || error || false
     */

    public function insert($with, $tables)
    {
        return $this->_insertUpdate($with, $tables, 'insert');
    }
    public function update($with, $tables)
    {
        return $this->_insertUpdate($with, $tables, 'update');
    }

    private function _insertUpdate($with=false, $tables=[], $operator)
    {
        // инициируем автомат. загрузку данных если $this->loadedData пуст
        // это происходит когда работаем с поисковыми методами findAll() и findOne()
        // и не хотим использовать в контроллере вызов load($data)
        if ( !$this->alreadyLoaded )
        {
            $this->loadFromFinder(LoadedData::$LoadedData);
        }

        $result = [];
        if ( $with === true ) // вставим все связанные данные
        {
            if ( empty($tables) )
            {
                $tables = $this->tableRelationsSchema;
            } else {
                $tables = array_flip($tables);
            }

            // проверка на вставку много записей findAll()
            if ( is_array($this->loadedData) )
            {
                debug($this->tableName,'im here');

                $c = 0;
                foreach ($this->loadedData as $Object)
                {

                    // вставка в поля этой табл
                    $data = $this->loadedDataExecute( $this->tableName, $Object );
                    if ( $operator === 'insert' )
                    {
                        $result[$this->tableName][$c] = $this->_insert( $this->tableName, $data );
                        $lastId = $result[$this->tableName][$c]['insert_id'];
                        // $lastId нет когда не было вставки, соотв. вставлять данные из связанных табл - бессмысленно.
                        if ( !isset( $lastId ) ) continue;
                    }
                    if ( $operator === 'update' ) $result[$this->tableName][$c] = $this->_update( $this->tableName, $data );
                    $c++;


                    // вставка в поля связанных табл
                    foreach ($tables as $table => $noNeed) {
                        if ( $table == $this->tableName ) continue;
                        if ( $operator === 'insert' ) $result[$table][] = $this->_insert( $table, $this->loadedDataExecute( $table, $Object ), $lastId );
                        if ( $operator === 'update' ) $result[$table][] = $this->_update( $table, $this->loadedDataExecute( $table, $Object ) );
                    }
                }

                return $result;
            } else {
                // одна зааись на вставку. типа findOne()
                $data = $this->loadedDataExecute( $this->tableName );

                if ( $operator === 'insert' )
                {
                    $result[$this->tableName] = $this->_insert( $this->tableName, $data );
                    $lastId = $result[$this->tableName]['insert_id'];
                    // $lastId нет когда не было вставки, соотв. вставлять данные из связанных табл - бессмысленно.
                    if ( !isset( $lastId ) ) return $result;
                }
                if ( $operator === 'update' ) $result[$this->tableName] = $this->_update( $this->tableName, $data );

                foreach ($tables as $table => $noNeed)
                {
                    if ( $table == $this->tableName ) continue;
                    if ( $operator === 'insert' ) $result[$table] = $this->_insert( $table, $this->loadedDataExecute( $table ), $lastId );
                    if ( $operator === 'update' ) $result[$table] = $this->_update( $table, $this->loadedDataExecute( $table ) );
                }

            }
            return $result;

        } else {
            // по умолчанию вставляем только данные этой табл. $this->tableName
            // проверка на вставку много записей

            if ( is_array($this->loadedData) )
            {
                $res = [];
                foreach ($this->loadedData as $data)
                {
                    $dataEXE = $this->loadedDataExecute( $this->tableName, $data );
                    if ( $operator === 'insert' ) $res[] = $this->_insert( $this->tableName, $dataEXE );
                    if ( $operator === 'update' ) $res[] = $this->_update( $this->tableName, $dataEXE );
                }
                return $res;
            } else {
                $data = $this->loadedDataExecute($this->tableName);
                if ( $operator === 'insert' ) return $this->_insert($this->tableName, $data);
                if ( $operator === 'update' ) return $this->_update($this->tableName, $data);
            }

        }
    }

    /*
     * $tableName - имя табл в которую будем вставлять
     * $data - объект данных. data = field->value То, что бужем вставлять
     * $lastId - id - последней вставленной записи. Передается если вставляем строки в связанные табл.
     * формирует строу запроса и непосредственно делает вставку в БД
     *
     */
    protected function _insert($tableName, $data, $lastId = null) {

        // проверим пуст ли объект. Для этого запросим существование в нем полей
        //$this->tableRelationsSchema[$tableName]; //массив столбцов.
        $continue = false;
        foreach ( $this->tableRelationsSchema[$tableName] as $tableColumn => $valNotNeed )
        {
          if ( isset( $data->$tableColumn ) )
          {
              $continue = true;
              break;
          }
        }
        if ( !$continue ) return [];

        //$lastId - последний добав. id. Если он передан, значит добавление идет в связанную табл.
        // добавим поле parent_id для каждой строки, если вставляем много строк
        if ( isset($lastId) )
        {
            $relKey = $this->tableRelations[$tableName];
            $data->$relKey = [];
            foreach ( $data as $value ) {
                if ( is_array($value) )
                {
                    // проверим кол-во элементов в значении ( строки )
                    // сформируем правильное кол-во ключей связей
                    if ( count($data->$relKey) < count($value) )
                    {
                        $data->$relKey = [];
                        foreach ( $value as $val ) array_push($data->$relKey, $lastId);
                    }
                } else {
                    $data->$relKey = $lastId;
                }
            }
            //debug($data->$relKey,'$data->$relKey');
        }

        $columns = ''; // строка колонок типа = column1,column2
        $values = '';  // строка значений типа ('value1'),('value2') и т.д.

        // если $value = массив формируем строку значений типа ('value1','value2','value3'),('value1','value2','value3')
        $isArr = false;
        $multipleInsertValues = [];  //массив значений, заготовки

        // определим макс значение в массивах = ( должно вставиться $maxCount строк )
        $maxCount = 0;
        foreach ( $data as $k => $array )
        {
            if ( is_array($array) )
            {
                $cA = count($array);
                if ( $cA > $maxCount ) $maxCount = $cA;
            }
        }

        // начнем формировать столбцы и строки
        foreach ( $data as $column => $value ) {
            // уходим на primKey т.к. вставляем новую запись
            if ( $column === $this->tableRelationsSchema[$tableName]['primaryKey'] ) continue;

            $columns .= $column . ",";

            //если знач == примитив, формируем строку из этих значений
            if ( is_string($value) || is_numeric($value) ) {
                $values .= "'" . Validator::validateString($value) . "',";
                continue;
            }

            // если знач == массив, то нужно сформировать несколько строк
            if ( is_array($value) ) {

                $value = Validator::validateArr($value);
                // когда не хватает значений, добьем пустыми
                if ( count($value) < $maxCount )
                {
                    for ( $i=count($value); $i < $maxCount; $i++ )
                    {
                        $value[$i] = '';
                    }
                }

                $isArr = true; // флаг массива
                // массив из ключей = знач, что бы значения следующих столбцов добавить к ним
                foreach ($value as $key => $v) {
                    $multipleInsertValues[$key] .= "'$v',";
                }
            }
        }
        //debug($values,'$values',1);
        //debug($multipleInsertValues,'$multipleInsertValues');

        $columns = trim($columns, ',');

        // сформируем нужное ко-во строк. Будет мультивставка ('val1','val2'),('val1',''),('','val2') ...
        if ( $isArr === true ) {
            $values = '';
            foreach ($multipleInsertValues as $key => $vle)
            {
                // проверка если переданы все пустые инпуты - убираем эту запись
                if ( empty(trim($vle, ', \' ')) ) continue;

                $values .= '(' . trim($vle, ',') . '),';
            }
            $values = trim($values, ',');
        } else {
            $values = "(" . trim($values, ',') . ")";
        }

        //debug($columns,'$columns');
        //debug($values,'$values');

        return $this->add_Upd_Record( [$tableName, $columns, $values], 'insert' );
    }


    /*
     * @var object $data - объект данных из loaderExecute
     * @var string $tableName - тмя табл в которой хотим обновить
     *
     * обновляет данные в таблице по первичному ключу
     * update
     */
    protected function _update($tableName, $data) {

        // проверим пуст ли объект. Для этого запросим существование в нем полей
        //$this->tableRelationsSchema[$tableName]; //массив столбцов.
        $continue = false;
        foreach ( $this->tableRelationsSchema[$tableName] as $tableColumn => $valNotNeed )
        {
            if ( isset( $data->$tableColumn ) )
            {
                $continue = true;
                break;
            }
        }
        if ( !$continue ) return [];


        $primKey = $this->tableRelationsSchema[$tableName]['primaryKey'];
        $relKey = $this->tableRelationsSchema[$tableName]['relationKey'];


        // определим макс значение в массивах = ( должно вставиться $maxCount строк )
        $maxCount = 0;
        foreach ( $data as $k => $array )
        {
            if ( is_array($array) )
            {
                $cA = count($array);
                if ( $cA > $maxCount ) $maxCount = $cA;
            }
        }

        // будет один запрос
        if ( $maxCount === 0 )
        {
            $primKeyVal = $data->$primKey;
            if ( !isset( $primKeyVal ) ) return "Primary key does not exist. Nothing to update!";

            $where = $primKey."='$primKeyVal'";
            $columns = ''; // строка колонок типа = column1,column2

            // начнем формировать столбцы и строки
            foreach ( $data as $column => $value ) {

                //если знач == примитив, формируем строку из этих значений
                if ( is_string($value) || is_numeric($value) ) {

                    if ( $column === $primKey ) continue; // уходим на primKey т.к. зачем нам его обновлять???
                    if ( $column == $relKey ) continue;  // уходим если колонка === relationKey т.е parent_id
                    if ( !isset( $this->tableRelationsSchema[$tableName][$column] ) ) continue; // уходим если такой колонки нет в табл.

                    $columns .= $column . "='" . $value . "',"; // запоминаем колонку.
                }
            }

            $columns = trim($columns, ',');

            return $this->add_Upd_Record( [$tableName, $columns, $where], 'update' );
        }


        // будет несколько запросов
        if ( $maxCount > 0 )
        {
            // формируем обратный масс( так удобнее )
            $output = [];
            for ( $i = 0; $i < $maxCount; $i++ )
            {
                $normalizeObj = new Obj([]);
                foreach ( $data as $name => $arr ) $normalizeObj->$name = $arr[$i];
                $output[] = $normalizeObj;
            }

            $result = [];

            foreach ( $output as $object )
            {
                $primKeyVal = $object->$primKey;
                if ( !isset( $primKeyVal ) )
                {
                    $result['error'][] = "Primary key does not exist. Nothing to update!";
                    continue;
                }

                $where = $primKey."='$primKeyVal'";
                $columns = ''; // строка колонок типа = column1,column2

                // начнем формировать столбцы и строки
                foreach ( $object as $column => $value )
                {
                    if ( is_string($value) || is_numeric($value) )
                    {
                        if ( $column === $primKey ) continue; // уходим на primKey т.к. зачем нам его обновлять???
                        if ( $column == $relKey ) continue;  // уходим если колонка === relationKey т.е parent_id
                        if ( !isset( $this->tableRelationsSchema[$tableName][$column] ) ) continue; // уходим если такой колонки нет в табл.
                        $columns .= $column . "='" . $value . "',"; // запоминаем колонку.
                    }
                }

                $columns = trim($columns, ',');
                $result[] = $this->add_Upd_Record( [$tableName, $columns, $where], 'update' );
            }

            return $result;
        }

        return [];
    }


    /*
     * работает тольк одля одной записи пришедшей из формы
     * делает insert() если нет первичногшо ключа $this->primaryKeyVal;
     * делает update() если он есть
     */
    public function save($with=false, $tables=[])
    {

        // если данные содержат id ( primaryKey ) тогда обновляем
        if ( !empty($this->primaryKeyVal) )
        {
            return $this->update( $with, $tables );

        } else {
            return $this->insert( $with, $tables );
        }

    }


    /*
     * @param number|array - $del
     * @param array - $with - имя связанной таблицы, из которой тоже надо удалить записи
     * удаляем запись $del - id, массив(одна запись) / или массив записей
     * пример: $stock->delete(30, ['files','repairs']);
     * return array;
     */
    public function delete($del=null, $with=[])
    {
        $query = '';
        $that = $this;
        $withF = function($del, $with, $or=null) use($that)
        {
            $leftJoin = "";
            $dopTables = '';
            foreach ( $with as $table )
            {
                if ( !array_key_exists($table, $that->tableRelations) ) continue;
                $leftJoin .= " LEFT JOIN $table ON $table.{$that->tableRelations[$table]}=$that->tableName.$that->primaryKey";
                $dopTables .= $table.",";
            }
            $dopTables = trim($dopTables,',');

            if ( $or !== null ) $or = "OR " . $or;

            return "DELETE $that->tableName,$dopTables
                          FROM $that->tableName
                          $leftJoin
                          WHERE $that->tableName.$that->primaryKey='$del' $or
                ";
            /*
               DELETE  user_relation, event_relation
               FROM relation
               LEFT JOIN user_relation ON user_relation.relation_id = relation.id
               LEFT JOIN event_relation ON event_relation.relation_id = relation.id
               WHERE  relation.id = 2
            */
        };

        if ( !isset($del) )
        {
            // инициируем автомат. загрузку данных если $this->loadedData пуст
            // это происходит когда работаем с поисковыми методами findAll() и findOne()
            // и не хотим использовать в контроллере вызов load($data)
            if ( !$this->alreadyLoaded )
            {
                $del = $this->loadFromFinder(LoadedData::$LoadedData);
                $this->alreadyLoaded = true;
            }
        }

        if ( is_int($del) )
        {
            if ( !empty($with) ) {
                $query = $withF($del, $with);
            } else {
                $query = "DELETE FROM $this->tableName WHERE $this->primaryKey='$del'";
            }
        }

        if ( is_array($del) )
        {
            if ( array_key_exists($this->primaryKey,$del) )
            {
                if ( !empty($with) ) {
                    $query = $withF($del[$this->primaryKey], $with);
                } else {
                    $query = "DELETE FROM $this->tableName WHERE $this->primaryKey='{$del[$this->primaryKey]}'";
                }
            }

            //массив записей, удаляем все
            if ( is_int(array_key_first($del)) ) // если ключи числовые, то считаем это массовом записей
            {
                $where = 'WHERE';
                $queryArr = [];
                foreach ( $del as $record )
                {
                    if ( array_key_exists($this->primaryKey,$record) )
                    {
                        $primKey = $this->primaryKey;
                        if ( !empty($with) ) {
                            $queryArr[] = $withF($record->$primKey, $with);
                        } else {
                            $where .= " $this->primaryKey='{$record->$primKey}' OR";
                        }
                    }
                }
                if ( count($with) > 0 ) {
                    $result = [];
                    foreach ($queryArr as $quer)
                    {
                        $result[] = $this->sqlQuery($quer);
                    }
                    return $result;
                } else {
                    $where = trim($where,'OR');
                    $query = "DELETE FROM $this->tableName $where";
                }
            }
        }

        if ( is_object($del) )
        {
            if ( array_key_exists($this->primaryKey, $del) )
            {
                $primKey = $this->primaryKey;
                if ( !empty($with) )
                {
                    $query = $withF($del->$primKey, $with);
                } else {
                    $query = "DELETE FROM $this->tableName WHERE $this->primaryKey='{$del->$primKey}'";
                }
            }
        }
        return $this->sqlQuery($query);
    }

    /*
     * очистим таблицу целиком
     */
    public function clearTable()
    {
        return $this->sqlQuery("DELETE FROM $this->tableName");
    }
}