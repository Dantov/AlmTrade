<?php

namespace admin\models;


use dtw\Model;

class StockModel extends Model
{


    public function stock() {

        return $this->activeDataBase( ['images' => 'pos_id'] );
    }

    public function images() {

        return $this->activeDataBase();
    }

    public function positionForm()
    {
        $labels = [
            'name' => 'Полное Имя',
            'short_name'=>'Короткое Имя',
            'description' => 'Описание',
        ];
        $rules = [
            'required' => [
                ['name'],
                ['short_name'],
            ],
        ];
        return $this->activeForm('stock',$rules,$labels);
    }

    public function uploadRules()
    {
        return [
            // имя в форме откуда придут файлы => [массив правил]
            'images' => [
                'name' => [['replace'=>"random"]], // изменяет имя файла, 'replace' = true|false - заменяет имя полностью | добавляет в начало
                'skipOnEmpty' => true,              // пропустить если поле пустое
                'extensions' => 'png,jpg,gif',      //доступные расширения (если пуст или отсутствует - принимает все файлы)
                'path' => 'views/images/stock',             // путь для загрузки файлов(если пуст - загружает в корневую папку /uploads)
                'size' => '4mb',                  // макс размер файла (только целое число)
                'maxFiles' => 15,                  // макс кол-во файлов (0 или пустая строка - все файлы)
            ],
        ];
    }

    public function uploadFiles()
    {
        return $this->upload();
    }

}