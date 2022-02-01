<?php

namespace dtw;


class Obj
{

    public function __isset($name)
    {
        return isset($this->$name);
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get( $name )
    {
        return "";
        //return "Can't find property <b>$name</b>";
    }

    public function __construct($vars=[])
    {

        foreach ( $vars as $cvar => $val ) {
            $this->$cvar = $val;
        }

    }
}