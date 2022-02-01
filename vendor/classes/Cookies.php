<?php

namespace dtw;

/*
 * работа с куками здесь
 */
class Cookies
{

    /*
     * активные куки здесь
     */
    public static $cookies = [];

    public static function set($name, $value, $time=null)
    {
        if ( empty($name) || empty($value) ) return false;
        if ( empty($time) || !is_int($time) ) $time = time()+3600; // час
        if ( setcookie($name, $value, $time, '/', $_SERVER['HTTP_HOST'] ) )
        {
            self::$cookies[$name] = $value;
            return true;
        }
        return false;
    }

    public static function getCookies()
    {
        return self::$cookies;
    }

    public static function get()
    {
        return $_COOKIE;
    }

    public static function getOne($name)
    {
        if ( isset($_COOKIE[$name]) ) return $_COOKIE[$name];
        return false;
    }

}