<?php

namespace Models;

use dtw\Model;


class HomeModel extends Model
{
    
    public function home() {

        return $this->activeDataBase();
    }
    
    
}
