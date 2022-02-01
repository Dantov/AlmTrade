<?php

namespace admin\models;

use dtw\Model;

class ContactsModel extends Model
{
    
    public function contacts() {

        return $this->activeDataBase('contacts_en');
    }
    
    public function contactsForm()
    {
        $labels = [
            'name' => 'Frame Name',
            'descr'=>'Frame Text',
        ];
        $rules = [
            /*
            'required' => [
                ['name'],
                ['short_name'],
            ],
             */
        ];
        return $this->activeForm('contacts_en',$rules, $labels);
    }
    
    
}
