<?php

namespace admin\controllers;

use admin\models\ContactsModel;
use dtw\Validator;

class ContactsController extends AppAdminController
{
    
    
    public function action()
    {
        
        $model = new ContactsModel();
        
        if ( isset($this->post['removeposId']) )
        {
            $id = (int) $this->post['removeposId'];
            $data = $model->contacts();
            $dell = $data->delete($id);
            
            $arr['ok'] = 1;
            echo json_encode($arr);
            exit;
        }
        
        if ( isset($this->params['edit']) )
        {
            $affR = $this->actionEdit($model);
            
            $this->redirect('/almadmin/contacts');
        }
        
        $contact = $model->contacts();
        $contactsForm = $model->contactsForm();
        
        $contacts = $contact->findAll()->go();
        
        return $this->render('contacts',compact('contacts','contactsForm'));
    }
    
    protected function actionEdit($model)
    {
        $dataUpd['contacts_en'] = $this->post['contacts_en'];
        $dataAdd['contacts_en'] = $this->post['contacts_en_new'];
        
        //debug($dataUpd,'$dataUpd',1);
        
        if ( !empty($dataUpd['contacts_en']) )
        {
            $contUpd = $model->contacts();
            $loadedUpd = $contUpd->load($dataUpd);
            //debug($loadedUpd,'$loadedUpd',1);
            foreach( $loadedUpd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedUpd->$key = $valid;
            }
            $savedUpd = $contUpd->update();
            
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
        
        if ( !empty($dataAdd['contacts_en']) )
        {
            $contAdd = $model->contacts();
            $loadedAdd = $contAdd->load($dataAdd);
            
            //debug($loadedAdd,'$loadedAdd',1);
            
            foreach( $loadedAdd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedAdd->$key = $valid;
            }
            $savedAdd = $contAdd->insert();
            
            //debug($savedUpd,'$savedUpd',1);
            
            if ( $ok ) $this->session->setFlash("success_upd", "блоки добавлены успешно!");
        }
        
        return $saved;
    }
}
