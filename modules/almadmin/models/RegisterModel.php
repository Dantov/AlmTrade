<?php

namespace admin\models;


use dtw\Model;

class RegisterModel extends Model
{

    public function users()
    {
        return $this->activeDataBase('users');
    }

    public function regForm() {
        $tableName = 'users';

        $labels = [
            'name' => 'Имя:',
            'login' => 'Логин:',
            'password'=>'Пароль:',
            'email' => 'Электро-почта:',
        ];
        $rules = [
            //attribute name => [массив правил]
            'required' => [
                ['name'],
                ['login'],
                ['password'],
                ['email'],
            ],
            'email' => [
                ['email']
            ],
            'lengthMin' => [
                ['password'=> 6]
            ],
        ];
        return $this->activeForm($tableName, $rules, $labels);
    }

}