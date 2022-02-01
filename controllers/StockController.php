<?php

namespace controllers;

use Models\StockModel;
use widgets\Widget;

class StockController extends GeneralController
{
    public $title = "AlmTrade s.r.o :: Stock";

    public function action()
    {
        $this->js = [
            'js/stock.js' => 'endBody',
        ];
        
        $model = new StockModel();
        $stock = $model->stock();

        if ( isset($this->params['show']) )
        {
            $result = $this->actionShow($stock);
            $machine = $result['machine'];
            $prev = $result['prev'];
            $next = $result['next'];
            return $this->render('show',compact('machine','prev','next'));
        }
        /*выборка из базы для стока*/

        //$machines = $stock->findAll()->with()->go();
        $machines = $stock->findAll()->orderBy('date DESC')->with()->go();

        //$weBuy = new Widget();

        return $this->render('stock', compact('machines'));
    }


    protected function actionShow($stock)
    {
        /*выборка из базы по алиасу*/
        //$alias = $this->params['show'];
        
        $this->js = [
            'js/imageViewer.js' => 'endBody',
        ];

        $id = (int)$this->params['show'];
        $result = [];

        $machine = $stock->findOne()->where(['id','=',$id])->with()->go();
        $allIds = $stock->findAll(['id','short_name'])->go();

        for ($i = 0; $i < count($allIds); $i++ ) {
            if ( $allIds[$i]->id == $id ) {
                $a = $i - 1;
                $b = $i + 1;
                $result['prev']['id'] = $allIds[$a]->id?: "";
                $result['prev']['short_name'] = $allIds[$a]->short_name?: "";

                $result['next']['id'] = $allIds[$b]->id?: "";
                $result['next']['short_name'] = $allIds[$b]->short_name?: "";
                break;
            }
        }

        $result['machine'] = $machine;

        return $result;
    }
}