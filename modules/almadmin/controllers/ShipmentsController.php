<?php

namespace admin\controllers;

use dtw\Validator;
use admin\models\ShipmentsModel;

/**
 * Description of ShipmentsController
 *
 * @author Вадим
 */
class ShipmentsController extends AppAdminController
{
    
    public function action()
    {
        $model = new ShipmentsModel();
        
        if ( isset($this->post['removeposId']) )
        {
            $id = (int) $this->post['removeposId'];
            $shipment = $model->shipments();
            $deleted = $shipment->delete($id);
            $arr['ok'] = 1;
            echo json_encode($arr);
            exit;
        }
        
        if ( isset($this->params['edit']) )
        {
            $affR = $this->actionEdit($model);
            
            $this->redirect('/almadmin/shipments');
        }
        
        
        $shipment = $model->shipments();
        $formShipments = $model->shipmentsForm();
        $shipments = $shipment->findAll()->go();
        
        $this->render('shipments', compact('shipments','formShipments'));
    }
    
    protected function actionEdit($model)
    {
        $dataUpd['shipments'] = $this->post['shipments'];
        $dataAdd['shipments'] = $this->post['shipments_new'];

        //debug($this->post,'$savedUpd',1);
        
        if ( !empty($dataUpd['shipments']) )
        {
            $shUpd = $model->shipments();
            $loadedUpd = $shUpd->load($dataUpd);
            
            foreach( $loadedUpd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedUpd->$key = $valid;
            }
            
            $savedUpd = $shUpd->update();
            //debug($savedUpd,'$savedUpd',1);

            $ok = 0;
            for ($i = 0; $i < count($savedUpd); $i++)
            {
                if ( $savedUpd[$i]['affected_rows'] )
                {
                    $ok = 1;
                    break;
                }
            }
            if ( $ok )
            {
                $this->session->setFlash("success_upd", "Изменения внесены успешно!");
            } else {
                 $this->session->setFlash("no_upd", "Изменений не было.");
            }
        }
        
        if ( !empty($dataAdd['shipments']) )
        {
            $upload = [];
            if ( $this->files )
            {  
                debug($this->files,'$this->files');
                $upload = $model->uploadFiles()->saveAs();
                for ($i = 0; $i < count($upload); $i++)
                {
                    if ( !empty($upload[$i]['error']) )
                    {
                        $this->session->setFlash("no_upd", "Произошла ошибка при загрузке файла!");
                        $this->redirect('/almadmin/shipments');
                    }
                }
                
                //debug($upload,'$upload');
            }
            
            $img['shipments'] = [];

            for ($i = 0; $i < count($upload); $i++)
            {
                if ( $upload[$i]['upload'] == "success" )
                {
                    $img['shipments']['img'][] = $upload[$i]['name'];
                    $img['shipments']['descr'][] = $dataAdd['shipments']['descr'][$i];
                }
            }
                
            $shAdd = $model->shipments();
            $loadedAdd = $shAdd->load($img);
            //debug($loadedAdd,'$imgLoaded',1);
            
            foreach( $loadedAdd as $key => $array )
            {
                $valid = Validator::validateArr($array);
                $loadedAdd->$key = $valid;
            }
            
            $savedImg = $shAdd->insert();
            //debug($savedImg,'$savedImg',1);
            $this->session->setFlash("success_add", "Позиции добавлены успешно!");
            if ( !$ok ) $this->session->dellKey("no_upd");
        }

    }
    
    
}


/*
$upload = Array
(
    [0] => Array
        (
            [path] => F:/AppServ/www/newAlmTrade/views/images/shipments
            [name] => img_shipment_1549629609.jpg
            [upload] => success
            [error] => 
        )

)
 *  */