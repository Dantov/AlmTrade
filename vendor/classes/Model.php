<?php

namespace dtw;

use dtw\db\ActiveRecord;


class Model {

    public function __construct()
    {

    }

    /*
     * @var string $tableName - имя табл.
     * @var array $relations - массив связей
     */
    protected function activeDataBase( $tableName="", $relations=[] ) {

        if ( is_array($tableName) && !empty($tableName) && empty($relations) )
        {
            $relations = $tableName;
            $tableName = debug_backtrace()[1]['function'];
        } elseif( (is_array($tableName) && empty($tableName)) || (is_string($tableName) && empty($tableName)) )
        {
            $tableName = debug_backtrace()[1]['function'];
        }

        return new ActiveRecord($tableName, $relations);
    }

    /*
     * загрузка файлов
     */
    protected function upload($uploadedFiles=[])
    {
        return new Uploader( $uploadedFiles, $_FILES, $this->uploadRules() );
    }

    /*
     * @var string $tableName - имя таблицы в БД
     * вернет объект формы
     * return object
     */
    protected function activeForm($tableName='', $rules=[], $attributeLabels=[])
    {
        /*
         * пусть он установит в объект FormOb]ect
         * некоторые правила public vars
         */
        if ( !empty($tableName) && is_string($tableName) )
        {
            $vars['formName'] = $tableName;
        } else {
            $vars['formName'] = debug_backtrace()[1]['function'];
        }
        //debug($vars['formName'],'$vars[\'formName\']');

        if ( !empty($rules) ) $vars['rules'] = $rules;
        if ( !empty($attributeLabels) ) $vars['attributeLabels'] = $attributeLabels;

        $obj = new FormObject($vars);

        /*
         * добавим объект формы в реестр
         * для использования его правил
         */
//        $reg = Registry::instance();
//        $reg->addObj($tableName,$obj);

        return $obj;
    }

    public function formNames()
    {
        return [];
    }

    public function uploadRules()
    {
        return [];
    }
}