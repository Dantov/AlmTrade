<?php

namespace admin\models;


class LoginFormModel extends \dtw\Model
{


    public function users()
    {
        return $this->activeDataBase('users');
    }

    public function loginForm() {
        $tableName = 'users';
        $labels = [
            'login' => 'Логин:',
            'password'=>'Пароль:',
            'email' => 'Электро-почта:',
        ];
        $rules = [
            //attribute name => [массив правил]
            'required' => [
                ['login'],
                ['password'],
                ['email'],
            ],
            'email' => [
                ['email']
            ],
            'lengthMin' => [
                ['password'=> 5]
            ],

//            'login' => [ 'required','string' ],
//            'password' => [ 'required','string','password','length'=>[5,25] ],
//            'email'=> [ 'required','string','email' ],

        ];
        return $this->activeForm($tableName, $rules, $labels);
    }


}