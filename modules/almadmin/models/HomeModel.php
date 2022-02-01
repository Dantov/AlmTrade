<?php

namespace admin\models;

use dtw\Model;


class HomeModel extends Model
{
    
    public function home() {

        return $this->activeDataBase();
    }
    
    
    public function homeForm()
    {
        $labels = [
            'logotext' => 'Logo Text',
            'maintext'=>'Banner 1',
            'offtext' => 'Banner 2',
        ];
        $rules = [
            /*
            'required' => [
                ['name'],
                ['short_name'],
            ],
             */
        ];
        return $this->activeForm('home',$rules, $labels);
    }
}
