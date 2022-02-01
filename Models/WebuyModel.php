<?php

namespace Models;

use dtw\Model;

class WebuyModel extends Model
{
    public function webuy() 
    {
        return $this->activeDataBase('webuy_en');
    }
    
}
