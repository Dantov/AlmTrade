<?php

namespace Models;

use dtw\Model;

class ContactsModel extends Model
{
    
    public function contacts() {

       return $this->activeDataBase('contacts_en');
    }
    
    public function mailForm() {

        $labels = [
            'login' => 'Логин:',
            'password'=>'Пароль:',
            'email' => 'Электро-почта:',
        ];
        $rules = [
            //attribute name => [массив правил]
            'required' => [
                ['name'],
                ['subject'],
                ['email'],
            ],
            'email' => [
                ['email']
            ],
        ];
        
        return $this->activeForm('', $rules, '');
    }
    
}
