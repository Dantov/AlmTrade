<?php

namespace dtw;

//use errors\ClassNotFoundException;

class Autoloader
{

    protected static $aliases = [];

    public function __construct($aliases)
    {
        if ( is_array($aliases) )
        {
            foreach ( $aliases as $alias => $path )
            {
                static::$aliases[$alias] = $path;
            }
        }
        spl_autoload_register([$this,'autoload']);
    }

    protected function autoload($class)
    {
        //заменяет обратный слешь на прямой для unix систем
        $class = str_replace('\\','/', $class);

        $e = explode('/',$class);
        $alias = $e[0];
        //$restPath = $e[1];

        if ( array_key_exists($alias,static::$aliases) )
        {
            $class = str_replace($alias, static::$aliases[$alias], $class);
            //$class = static::$aliases[$alias] .'/'. $restPath;
        }

        $class = _rootDIR_ .'/'. $class . '.php';

        //debug($class,'$class');
        try
        {

            if ( file_exists($class) ) {

                require_once $class;

            } else {

                include _rootDIR_ . '/vendor/classes/error/ClassNotFoundException.php';
                throw new \errors\ClassNotFoundException( $class );
            }
        } catch (\Exception $exception)
        {
            //debug($exception,'Autoloader Exception');
        }

    }

    public static function setAlias($alias, $path)
    {
        if ( is_string($alias) && is_string($path) )
        {
            self::$aliases[$alias] = $path;
            return true;
        }
        return false;
    }

    public static function getAlias($alias)
    {
        if ( array_key_exists(self::$aliases,$alias) )
        {
            return self::$aliases[$alias];
        }
        return false;
    }


}