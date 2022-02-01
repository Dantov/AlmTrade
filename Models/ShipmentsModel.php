<?php

namespace Models;

use dtw\Model;

class ShipmentsModel extends Model
{
    
    public function shipments() 
    {
        return $this->activeDataBase();
    }
    
}
