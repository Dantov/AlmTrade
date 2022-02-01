<?php

namespace admin\controllers;

use dtw\Validator;
use admin\models\StockModel;

class StockController extends AppAdminController
{

    public function action()
    {
        $model = new StockModel();

        if ( isset($this->post['removeImgId']) )
        {
            $id = (int) $this->post['removeImgId'];
            $images = $model->images();
            $deleted = $images->delete($id);
            $arr['ok'] = 1;
            echo json_encode($arr);
            exit;
        }
        
        $stock = $model->stock();

        if ( isset($this->params['remove']) )
        {
            $id = (int) $this->params['remove'];
            $done = $this->actionRemove($model,$id);
            if ( (int)$done['affected_rows'] )
            {
                $this->session->setFlash("success_dellPosition", "Позиция ". $done['name'] ." удалена успешно!");
            } else {
                $this->session->setFlash("error_dellPosition", "При удалении позиции ". $done['name'] ." произошла ошибка!");
            }
            $this->redirect('/almadmin/stock/');
        }
        
        if ( isset($this->params['edit']) )
        {
            $id = $this->actionEdit($model);
            $this->redirect('/almadmin/stock/show/'.$id);
        }
        
        if ( isset($this->params['show']) )
        {
            $position = $model->positionForm();
            $machine = $this->actionShow($stock);
            return $this->render('show',compact('machine','position'));
        }
        
        
        if ( isset($this->params['insert']) )
        {
            $result = $this->actionAdd($model);

            if ( (int)$result['insert_id'] )
            {
                $this->session->setFlash("success_add", "Позиция ". $result['name'] ." успешно добалена!");
            } else {
                $this->session->setFlash("error_add", "При добавлении ". $result['name'] ." произошла ошибка!");
            }

            $this->redirect('/almadmin/stock/');
        }
        
        
        if ( isset($this->params['add']) )
        {
            $position = $model->positionForm();
            return $this->render('add',compact('position'));
        }
        
        
        
        $machines = $stock->findAll()->with()->go();
        return $this->render('stock',compact('machines'));
    }

    protected function actionShow($stock)
    {
        $id = (int)$this->params['show'];

        $machine = $stock->findOne()->where(['id','=',$id])->with()->go();

        return $machine;
    }




    protected function actionEdit($model)
    {
        $stock = $model->stock();
        $images = $model->images();

        $id = (int)$this->params['edit'];

        $data = $this->post;
        $data['stock']['id'] = $id;

        //debug($data,'$data');

        /* новые изображения */
        if ( $files = $this->files )
        {
            $upload = $model->uploadFiles()->saveAs();
            for ($i = 0; $i < count($upload); $i++)
            {
                if ( !empty($upload[$i]['error']) )
                {
                    $this->session->setFlash("error_add", "Произошла ошибка при загрузке картнки!");
                    $this->redirect('/almadmin/stock/show/'.$id);
                }
            }

            $img = [];
            for ($i = 0; $i < count($upload); $i++)
            {
                if ( $upload[$i]['upload'] == "success" )
                {
                    $img['images']['img_name'][] = $upload[$i]['name'];
                    $img['images']['pos_id'][] = $id;
                }
            }

            $imgLoaded = $images->load($img);
            $savedImg = $images->insert();
            if ( (int)$savedImg['affected_rows'] )
            {
                $this->session->setFlash("success_add", "картинки добавлены успешно!");
            }
            //debug($savedImg,'$savedImg',1);
        }


        /* проверка маин инпут на всех изобр (переставляем маин инпут)*/
        $mainImgId = $data['mainImg'];
        $ids = $images->findAll(['id','main'])->where(['pos_id','=',$id])->go();
        foreach ($ids as $obj) 
        {
            if ($obj->id == $mainImgId ) 
            {
                $obj->main = 1;
            } else {
                $obj->main = "null";
            }               
        }
        //debug($data,'$data');
        //debug($ids,'$ids');

        // проапдейтили флажки
        $imgIDLoaded = $images->load($ids);
        //debug($imgLoaded,'$imgLoaded');
        $savedIDImg = $images->update();
        //debug($savedImg,'$savedImg',1);
        // больше не нужна в стоке
        unset($data['mainImg']);
        /*end*/

        $machine = $stock->load($data);
        foreach( $machine as $key => $array )
        {
            if ( $key == 'id' ) continue;
            $valid = Validator::validateString($array);
            $machine->$key = $valid;
        }
        $updated = $stock->update();

        //debug($updated,'update',1);

        if ( (int)$updated['affected_rows'] )
        {
            $this->session->setFlash("success_upd", "Изменения внесены успешно!");
        }

        return $id;
    }




    protected function actionAdd($model)
    {
        $stock = $model->stock();
        $image = $model->images();

        $res = [];
        $machine = [];
        $upload = [];

        if ( $this->files )
        {
            //debug($this->files,'$this->files');

            $upload = $model->uploadFiles()->saveAs();
            for ($i = 0; $i < count($upload); $i++)
            {
                if ( !empty($upload[$i]['error']) )
                {
                    $this->session->setFlash("error_add", "Произошла ошибка при загрузке картнки!");
                    $this->redirect('/almadmin/stock');
                }
            }

            //debug($upload,'$upload');
        }

        if ( $this->post )
        {
            $data = $this->post;

            $machine = $stock->load($data);
            $machine->date = date('Y-m-d');

            //debug($machine,'$machine');
            foreach( $machine as $key => $array )
            {
                if ( $key == 'id' ) continue;
                $valid = Validator::validateString($array);
                $machine->$key = $valid;
            }
            $savedStock = $stock->insert();
            //debug($savedStock,'$saved');

            $res['insert_id'] = $savedStock['insert_id'];

            $img = [];
            for ($i = 0; $i < count($upload); $i++)
            {
                if ( $upload[$i]['upload'] == "success" )
                {
                    $img['images']['img_name'][] = $upload[$i]['name'];
                    $img['images']['pos_id'][] = $res['insert_id'];

                    if ( $i < 1 )
                    {
                        $img['images']['main'][$i] = 1;
                    } else {
                        $img['images']['main'][$i] = 'null';
                    }
                }
            }
            $images  = $image->load($img);
            $savedImg = $image->insert();

            //debug($savedImg,'$savedImg',1);

            $res['name'] =  $machine->short_name;
        } else {
            $this->redirect('/almadmin/stock/');
        }

        return $res;
    }

    protected function actionRemove($model,$id)
    {
        $stock = $model->stock();

        $pos = $stock->findOne()->where(['id','=',$id])->go();

        $deleted = $stock->delete($id, ['images']);
        $deleted['name'] = $pos->short_name;
        return $deleted;
    }

}