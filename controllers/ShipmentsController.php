<?php

namespace controllers;

use Models\ShipmentsModel;

class ShipmentsController extends GeneralController
{

    public $title = "AlmTrade s.r.o :: Shipments";

    public function action()
    {
        
        $model = new ShipmentsModel();
        $shipment = $model->shipments();
        
        $shipments = $shipment->findAll()->go();
        
        return $this->render('shipments',compact('shipments'));
    }

}