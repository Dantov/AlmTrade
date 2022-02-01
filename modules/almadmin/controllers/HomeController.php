<?php

namespace admin\controllers;

use admin\models\HomeModel;
use dtw\Validator;

class HomeController extends AppAdminController
{
    
    
    public function action()
    {
        $homeModel = new HomeModel();
        
        if ( isset($this->params['edit']) )
        {
            $affR = $this->actionEdit($homeModel);
            if ( $affR ) 
            {
                $this->session->setFlash("success_upd", "Изменения внесены успешно!");
            } else {
                $this->session->setFlash("no_upd", "Не было изменений!");
            }
            
            $this->redirect('/almadmin/home');
        }

        $homeForm = $homeModel->homeForm();
        $home = $homeModel->home();
        $hometext = $home->findOne()->go();
        
        return $this->render('home',compact('homeForm','hometext'));
    }
    
    protected function actionEdit($homeModel)
    {
        $home = $homeModel->home();
        $data = $this->post;
        
        $loaded = $home->load($data);
        $loaded->id = 1;
        $loaded->logotext = Validator::validateString($loaded->logotext);
        $loaded->maintext = Validator::validateString($loaded->maintext);
        $loaded->offtext = Validator::validateString($loaded->offtext);
        
        //debug($loaded,'$loaded');
        
        $saved = $home->update();
        
        //debug($saved,'$saved',1);
        return $saved['affected_rows'];
    }
}
