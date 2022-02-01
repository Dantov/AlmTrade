<?php

namespace admin\models;

use dtw\Model;

class ShipmentsModel extends Model
{
    
    public function shipments()
    {
        return $this->activeDataBase();
    }
    
    public function shipmentsForm()
    {
        return $this->activeForm('shipments');
    }
    
    public function uploadRules()
    {
        return [
            // имя в форме откуда придут файлы => [массив правил]
            'shipments_new' => [
                'name' => [['replace' => 'random']], // изменяет имя файла, 'replace' = true|false - заменяет имя полностью | добавляет в начало
                'skipOnEmpty' => true,              // пропустить если поле пустое
                'extensions' => 'png,jpg,gif',      //доступные расширения (если пуст или отсутствует - принимает все файлы)
                'path' => '/views/images/shipments',             // путь для загрузки файлов(если пуст - загружает в корневую папку /uploads)
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