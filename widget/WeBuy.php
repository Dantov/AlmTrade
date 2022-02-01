<?php

namespace widget;

use widgets\Widget;
use Models\WebuyModel;

class WeBuy extends Widget
{
    public $webuy = [];
    
    public function init()
    {
        $model = new WebuyModel();
        
        $data = $model->webuy();
        $this->webuy = $data->findAll(['name'])->go();
    }
    
    public function run()
    {
        
        $this->render( _rootDIR_ . "/widget/webuy/view.php");
    }
    
    
}
