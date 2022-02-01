<?php

namespace admin\controllers;

use admin\models\RegisterModel;

class RegisterController extends AppAdminController
{

    public function action()
    {

        $model = new RegisterModel();
        $regForm = $model->regForm();

        if ( $this->post )
        {
            $users = $model->users();

            function setFields($regForm, $me)
            {
                foreach ( $me->post[$regForm->formName] as $field => $val )
                {
                    $me->session->setFlash($field, $val);
                }
            }

            if ( $regForm->validate() )
            {

                $loaded = $users->load($this->post);
                $loaded->password = password_hash($loaded->password, PASSWORD_DEFAULT);

                $saved = $users->save();

                if ( $saved['errno'] == 1062 )
                {
                    $err = explode(' ',$saved['error'])[5];
                    $errField = explode('_',$err)[1];

                    if ( $errField == 'login' ) $this->session->setFlash("error-login","Такой Login уже занят!");
                    if ( $errField == 'email' ) $this->session->setFlash("error-email","Такой Email уже занят!");

                    setFields($regForm, $this);

                    $this->refresh();
                } elseif ( empty($saved['errno']) )
                {
                    $this->session->setFlash("success-register","Регистрация прошла успешно! Теперь ");
                    $this->redirect('/admin/loginform');
                } else {
                    $this->session->setFlash("error-register","При регистрации возникла ошибка. Попробуйте позже.");
                    $this->refresh();
                }

            } else {
                //debug($loginform->getErrors());
                setFields($regForm, $this);
                foreach ( $regForm->getErrors() as $errors => $error )
                {
                    $this->session->setFlash("error-$errors", $error[0]);
                }
                $this->refresh();
            }
        }

        $this->render('register',compact('regForm'));
    }


}