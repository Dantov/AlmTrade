<?php

namespace dtw;

/*
 * Реестр
 * Содержит в себе список объектов
 */
class Registry
{

    private static $instance = false;
    private static $Objects = [];

    protected function __construct()
    {
        $classes = AppProperties::getConfig()['classes'];
        foreach ( $classes as $class => $path )
        {
            self::$Objects[$class] = new $path;
        }

        self::$instance = true;
    }

    public static function instance()
    {
        if ( is_object(self::$instance) )
        {
            return self::$instance;
        } else {
            self::$instance = new self;
            return self::$instance;
        }
    }

    public function setObj($name,$path)
    {
        if ( !empty($name) && !empty($path) )
        {
            self::$Objects[$name] = new $path;
        }
    }

    public function getObj($name)
    {
        if ( isset(self::$Objects[$name]) )
        {
            return self::$Objects[$name];
        }
        return null;
    }

    public function addObj($name, $obj)
    {
        if ( is_object($obj) && is_string($name) ) self::$Objects[$name] = $obj;
    }

}