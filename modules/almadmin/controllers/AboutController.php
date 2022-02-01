<?php

namespace admin\controllers;

use admin\models\AboutusModel;
use dtw\Validator;

class AboutController extends AppAdminController
{
    
    
    public function action()
    {
        $model = new AboutusModel();
        
        if ( isset($this->params['edit']) )
        {
            $saved = $this->actionEdit($model);
            if ( $saved[0]['affected_rows'] || $saved[1]['affected_rows'] ) 
            {
                $this->session->setFlash("success_upd", "Изменения внесены успешно!");
            } else {
                $this->session->setFlash("no_upd", "Не было изменений!");
            }
            
            if ( $saved['affected_img'] ) $this->session->setFlash("success_img", "Картинка добавлена!");
            
            $this->redirect('/almadmin/about');
        }
        
        $images = $model->images();
        $aboutusForm = $model->aboutusForm();
        $data = $model->aboutus();
        
        $aboutus = $data->findAll(['id','text_en'])->go();
        $img = $images->findOne()->where(['pos_id','=','0'])->go();
        
        return $this->render('about',compact('aboutus','aboutusForm','img'));
    }
    
    protected function actionEdit($model)
    {
        $aboutus = $model->aboutus();
        $images = $model->images();
        
        $data = $this->post;
        
        $loaded = $aboutus->load($data);
        
        //debug($loaded,'loaded not valid');
        
        foreach( $loaded as $key => $array )
        {
            $valid = Validator::validateArr($array);
            $loaded->$key = $valid;
        }
        
        if ( $this->files )
        {  
            $upload = $model->uploadFiles()->saveAs('/views/images/about');
            //debug($upload,'$upload',1);
            
            if ( $upload[0]['upload'] == "success" ) 
            {
                $img['images']['img_name'] = $upload[0]['name'];
                $img['images']['pos_id'] = "0";
                
                $imgLoaded = $images->load($img);
                //debug($imgLoaded,'$imgLoaded',1);
                //
                $savedImg = $images->save();
                //debug($savedImg,'$savedImg',1);
                
                $ok=1;
            } else {
                $this->session->setFlash("no_upd", "Произошла ошибка при загрузке файла!");
                $this->redirect('/almadmin/about');
            }
        }
        
        $saved = $aboutus->update();
        //debug($saved,'$saved',1);
        if ($ok) $saved['affected_img'] = 1;
        
        return $saved;
    }
    
}