<?php


namespace Models;
use dtw\Model;


class AboutModel extends Model
{
    
    
    public function aboutus() {

        return $this->activeDataBase();
    }
    
    public function images() {
        return $this->activeDataBase();
    }
    
    
}
