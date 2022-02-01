<?php

namespace dtw;


use dtw\db\DataBase;

class Validator
{

    protected static $rules;
    protected static $errors;

    public static $badChars = ['\'','.',',','\\','/','../','..\\','"',' ','+','%','()','&','?','$','@','*','(',')','{','}','[',']','|','!','#','^',':',';','`'];
    
    
    public static function emailValidation($mail)
    {
        
    }

    public static function validate($data)
    {
        $reg = Registry::instance();
        $v = $reg->getObj('validator');
        $v->rules(self::$rules);
        if ( $v->validate() ) return true;

        self::$errors = $v->errors();
        return false;
    }

    public static function setRules($rules)
    {

        if ( isset($rules) && is_array($rules) )
        {
            self::$rules = $rules;
        }

    }

    public static function getErrors()
    {
        if ( !empty(self::$errors) ) return self::$errors;
        return false;
    }
    /*
    * @param array|obj
    * проверяем данные static::$fromData на валидность
    * return valid data
    * */
    public static function validateString($data)
    {
        if ( !empty($data) && is_string($data) )
        {
            $MySQLi = DataBase::connect();
            $validated = htmlentities($data, ENT_QUOTES, 'UTF-8', true);
            $validated = $MySQLi->real_escape_string($validated);
            return $validated;
        }

        return false;
    }

    public static function validateArr($data)
    {
        if ( empty($data) ) return false;

        $res = [];
        // в объектах и массивах валидируем каждый элемент
        if ( is_array($data) ) {

            foreach ($data as $prop => $val) {
                if (is_array($val) ) {
                    foreach ($val as $key => $v) {
                        if ( is_string($v) )
                        {
                            $val[$key] = trim(self::validateString($v), '. / \\');
                        }
                    }
                } else {
                    if ( is_string($val) )
                    {
                        $val = trim(self::validateString($val), '. / \\');
                    }
                }
                $res[$prop] = $val;
            }
        }
        return $res;

    }

    public static function validateObj($data)
    {
        $obj = new Obj([]);

        // в объектах и массивах валидируем каждый элемент
        if ( is_object($data)  ) {

            foreach ($data as $prop => $val) {
                if (is_array($val) || is_object($val)) {
                    foreach ($val as $key => $v) {
                        if ( is_string($v) )
                        {
                            $val[$key] = trim(self::validateString($v), '. / \\');
                        }
                    }
                } else {
                    if ( is_string($val) )
                    {
                        $val = trim(self::validateString($val), '. / \\');
                    }
                }
                $obj->$prop = $val;
            }
        }
        return $obj;
    }
    
}