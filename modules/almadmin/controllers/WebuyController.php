<?php

namespace admin\controllers;

use dtw\Validator;
use admin\models\WebuyModel;

class WebuyController extends AppAdminController
{
    
    public function action()
    {
        $model = new WebuyModel();
        
        if ( isset($this->post['removeposId']) )
        {
            $id = (int) $this->post['removeposId'];
            $data = $model->webuy();
            $dell = $data->delete($id);
            
            $arr['ok'] = 1;
            echo json_encode($arr);
            exit;
        }
        
        if ( isset($this->params['edit']) )
        {
            $affR = $this->actionEdit($model);
            
            $this->redirect('/almadmin/webuy');
        }
        
        $data = $model->webuy();
        $webuyForm = $model->webuyForm();
        $webuy = $data->findAll(['id','name'])->go();
        
        return $this->render('webuy',compact('webuy','webuyForm'));
    }
    
    protected function actionEdit($model)
    {
        $dataUpd['webuy_en'] = $this->post['webuy_en'];
        $dataAdd['webuy_en'] = $this->post['webuy_en_new'];

        if ( !empty($dataUpd['webuy_en']) )
        {
            $webuyUpd = $model->webuy();
            $loadedUpd = $webuyUpd->load($dataUpd);
            
            foreach( $loadedUpd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedUpd->$key = $valid;
            }
            
            $savedUpd = $webuyUpd->update();
            
            //debug($savedUpd,'$savedUpd',1);
            
            $ok = 0;
            foreach( $savedUpd as $arr )
            {
                if( $arr['affected_rows'] == 1 ) {
                    $ok = 1;
                    break;
                }
            }
            if ( $ok ) $this->session->setFlash("success_upd", "Изменения внесены успешно!");
        }
        
        if ( !empty($dataAdd['webuy_en']) )
        {
            $webuyAdd = $model->webuy();
            $loadedAdd = $webuyAdd->load($dataAdd);

            foreach( $loadedAdd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedAdd->$key = $valid;
            }

            $savedAdd = $webuyAdd->insert();
            //debug($savedAdd,'$savedAdd',1);

            $this->session->setFlash("success_add", "Позиции добавлены успешно!");
        }
        
        //if ($ok) $saved['affected_img'] = 1;
        
        return $saved;
    }

}