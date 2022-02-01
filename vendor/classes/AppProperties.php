<?php

namespace dtw;


abstract class AppProperties
{

    protected static $routs=[
        'language' => '',
        'module' => '',
        'controller' => '',
        'view' => '',
        'layout' => '',
    ];
    /*
     * @array $config
     * массив конфигурации приложения
     * */
    protected static $config=[];

    /*
     * @array $params
     * разобранный массив параметров, пришедших из строки запроса
     * */
    protected static $params=[];

    /*
     * @string $controllerName
     * Имя текущего контроллера
     * */
    protected static $controllerName = '';

    /*
     * сеттеры
     */
    public static function setRout($rout)
    {
        if ( is_array($rout) )
        {
            foreach ($rout as $key => $val)
            {
                if ( array_key_exists($key, self::$routs) ) self::$routs[$key] = $val;
            }
        }
    }
    public static function setConfig($config)
    {
        if ( empty(self::$config) )
        {
            if ( is_array($config) ) self::$config = $config;
        }
    }
    public static function addConfig($config)
    {
        if ( is_array($config) )
        {
            foreach ($config as $key => $val)
            {
                self::$config[$key] = $val;
            }
        }
    }
    public static function setParams($params)
    {
        //if ( empty(self::$params) )
        //{
            if ( is_array( $params ) ) self::$params = $params;
        //}
    }
    public static function setControllerName($cn)
    {
        if ( empty(self::$controllerName) )
        {
            if ( is_string($cn) ) self::$controllerName = $cn;
        }
    }

    /*
     * геттеры
     */
    public static function getRout($rout)
    {
        if ( array_key_exists($rout, self::$routs) ) return self::$routs[$rout];
        return false;
    }
    public static function getRouts()
    {
        return self::$routs;
    }
    public static function getConfig()
    {
        return self::$config;
    }
    public static function getParams()
    {
        return self::$params;
    }
    public static function getControllerName()
    {
        return self::$controllerName;
    }
}