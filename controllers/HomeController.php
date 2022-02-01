<?php

namespace controllers;

use Models\StockModel;
use Models\HomeModel;

class HomeController extends GeneralController
{

    public $title = "AlmTrade s.r.o :: Home";

    public function action()
    {
        $stockModel = new StockModel();
        $homeModel = new HomeModel();
        
        $home = $homeModel->home();
        $stock = $stockModel->stock();

        $homeLogos = $home->findOne()->go();
        $machines = $stock->findAll(['id','name','short_name'])->where(['status','=','1'])->orderBy('date DESC')->with()->go();

        return $this->render('home',compact('machines','homeLogos'));
    }

}