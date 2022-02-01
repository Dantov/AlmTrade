<?php

namespace dtw\db;

/*
 * Это общий класс для реализации методов поиска, записи, и обновления базы данных
 * создается для каждой конкретной таблицы
 */

use dtw\Obj;

class ActiveRecord implements iRecord
{

    /*
     * objects
     */
    private $Finder;
    private $Record;


    /*
     *  $tableName имя текущей табл
     *  $tableRelations массив связей
     */
    private $tableName = '';
    private $tableRelations = [];


    /* ========== свойства доступа к данным ============ */

    /*
     * @var object $field
     * найденные данные методами findOne findAll
     * загруженные данные методом load()
     * которые можно редактировать
     * !! это св-во перезапишется при каждом вызове соответствующего метода
     *
     */
    public $field;
    
    public function __set( $name, $value )
    {

    }

    /* ================ методы ================= */
    public function __construct($tableName, $tableRelations=[])
    {
        $this->tableName = $tableName;
        $this->tableRelations = $tableRelations;

    }

    /* ========= служебные =========*/
    private function createRecord()
    {
        if ( !is_object($this->Record) )
        {
            $this->Record = new Record($this->tableName, $this->tableRelations);
        }
    }
    private function createFinder()
    {
        if ( !is_object($this->Finder) )
        {
            $this->Finder = new Finder($this->tableName, $this->tableRelations);
        }
    }

    /* ======== методы поиска ==========*/
    public function findOne($columns=[])
    {
        $x = new Finder($this->tableName, $this->tableRelations);
        return $x->findOne($columns);
    }

    public function findAll($columns=[])
    {
        $x = new Finder($this->tableName, $this->tableRelations);
        return $x->findAll($columns);
    }

    public function findBySQL($query)
    {
        $x = new Finder($this->tableName, $this->tableRelations);
        return $x->findBySQL($query);
    }
    /*
     * вернет число, можетбыть
     */
    public function count()
    {
        $this->createFinder();
        return  $this->Finder->count();
    }

    /* ======== методы обновления/записи ==========*/

    /*
     * загрузим данные из формы( $POST ) или др. объекта, в объект таблицы
     * в соответствии с заполненым массивом связей указанным в модели $this->activeDataBase( ['files' => 'parent_id', 'repairs' => 'parent_id'] );
     * если массив пуст - загрузит только данные с полей этой табл.
     */
    public function load($data=[])
    {
        $this->createRecord();

        if ( !array_key_exists($this->tableName, $data) )
        {
            return $this->Record->loadFromFinder($data);
        }
        return $this->Record->load($data);
    }

    /*
     * @var bool $with - флаг ниличия связей
     * @var array $tables - имена связанных таблиц
     * вставим данные в табл
     * вернет массив с результатами работы
     * return array
     */
    public function insert($with=false, $tables=[])
    {
        $this->createRecord();
        return $this->Record->insert($with, $tables);
    }

    /*
     * @var bool $with - флаг ниличия связей
     * @var array $tables - имена связанных таблиц
     * обновим данные в табл
     * вернет массив с результатами работы
     * return array
     */
    public function update($with=false, $tables=[])
    {
        $this->createRecord();
        return $this->Record->update($with, $tables);
    }

    /*
     * если встретит поле id у главной табл - будет обновлять!
     * иначе внесет как новую запись!
     * хочешь обновить связанные табл? Передавай поля primary key (id) вместе с данными!
     */
    public function save($with=false, $tables=[])
    {
        $this->createRecord();
        //if (  )
        return $this->Record->save($with, $tables);
    }

    /*
     * если встретит primary key (id) в $data, удалит данные из этой таб. и связанных табл. - Безвозвратно!
     * в $data можно передать число, или массив чисел, будет искать их в этой табл как primary key
     */
    public function delete( ... $params )
    {
        $data=$params[0];
        $tables=$params[1];

        if ( is_int($params[0]) ) $data=$params[0];

        if ( is_array($params[0]) )
        {
            $data=$params[0];
            if ( !is_int($data[0]) )
            {
                $tables = $data;
                $data = null;
            }
        }

        $this->createRecord();
        return $this->Record->delete($data, $tables);
    }

    /*
     * Безвозвратно удалит из этой табл. все данные
     */
    public function deleteAll()
    {
        $this->createRecord();
        return $this->Record->clearTable();
    }

}