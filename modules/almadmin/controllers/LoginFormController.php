<?php

namespace admin\controllers;

use admin\models\LoginFormModel;
use dtw\Controller;
use dtw\Registry;
use dtw\Validator;

class LoginFormController extends AppAdminController
{
    public $title = 'AlmTrade :: Sign In';
    public $layout = "signIn_tpl";
    
    public function action()
    {
        $model = new LoginFormModel();
        //$loginform = $model->loginForm();
        
        if ( $this->post )
        {
            $users = $model->users();

            $login = $this->post['users']['login'];
            $password = $this->post['users']['password'];

            $loginVal = Validator::validateString($login);
            $pass = $users->findOne(['password'])->where(['login','=',$loginVal])->go();

            //debug(password_hash('admin',PASSWORD_DEFAULT),'$pass',1);

            if ( empty($pass) )
            {
                $this->session->setFlash("error-login", "Have no users with this login");

                foreach ( $this->post['users'] as $field => $val )
                {
                    $this->session->setFlash($field, $val);
                }

                $this->refresh();
            }
            $validPass = Validator::validateString($password);

            if (password_verify($validPass,$pass->password))
            {
                $this->session->setKey('user',['authorized'=>1]);
                $this->redirect('/almadmin/admin');
            } else {
                $this->session->setFlash('error-password', 'Wrong password');

                $this->refresh();
            }
        }

        $this->render('loginform', compact('loginform'));
    }

}