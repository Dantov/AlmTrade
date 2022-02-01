<?php

namespace admin\models;

use dtw\Model;

class WebuyModel extends Model 
{
   
    public function webuy() {

        return $this->activeDataBase('webuy_en');
    }
    
    public function webuyForm()
    {
        $labels = [
//            'logotext' => 'Текст справа от логотипа',
//            'maintext'=>'Баннерный текст',
//            'offtext' => 'Текст под ним',
        ];
        $rules = [
            /*
            'required' => [
                ['name'],
                ['short_name'],
            ],
             */
        ];
        return $this->activeForm('webuy_en',$rules, $labels);
    }
    
}
