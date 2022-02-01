<?php

namespace admin\controllers;


class AdminController extends AppAdminController
{

    public function action()
    {
        if ( $this->params['exit'] == 1 ) $this->actionExit();





        return $this->render('admin');
    }

    public function actionExit()
    {
            $this->session->dellKey('user');
            $this->redirect('/home');
    }

}