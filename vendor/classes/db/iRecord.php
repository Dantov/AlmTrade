<?php

namespace dtw\db;


interface iRecord
{

    /*
     * найдет первую попавшуюся запись удовлетворяющую условию
     * ограничение LIMIT 1
     * вернет 1 массив столбец => знач
     */
    public function findOne($columns);

    /*
     * найдет все записи удовлетворяющие условиям
     * вернет массив массивов, даже при 1й найденной.
     * Типа:
     * array(
     * [0] => поля/значения,
     * [1] => поля/значения,
     * и т.д.
     * )
     */
    public function findAll($columns);

    /*
     * найдем в БД по SQL запросу
     */
    public function findBySQL($query);
    /*
     * вставим в одну или несколько таблиц, одну или несколько записей
     */
    public function insert();

    /*
     * обновим в одну или несколько таблиц, одну или несколько записей
     */
    public function update();

    /*
     * если нет id вносим данные методом insert()
     * иначе обновим update()
     * return array с результатами деятельности
     */
    public function save();

    /*
     * удалим из таблицы одну или несколько записей
     */
    public function delete();

    /*
     * очистим таблицу
     */
    public function deleteAll();

}