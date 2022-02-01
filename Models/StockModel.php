<?php

namespace Models;

use dtw\Model;

class StockModel extends Model
{

    public function stock() {

        return $this->activeDataBase( ['images' => 'pos_id'] );
    }

}