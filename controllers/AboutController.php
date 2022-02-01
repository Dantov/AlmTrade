<?php

namespace controllers;

use Models\AboutModel;

class AboutController extends GeneralController
{

    public $title = "AlmTrade s.r.o :: About";

    public function action()
    {

        $model = new AboutModel();
        
        $images = $model->images();
        $data = $model->aboutus();
        
        $aboutus = $data->findAll(['id','text_en'])->go();
        $img = $images->findOne()->where(['pos_id','=','0'])->go();
        
        return $this->render('about',compact('aboutus','img'));
    }

}