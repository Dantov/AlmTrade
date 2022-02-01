<?php

namespace admin\models;
use dtw\Model;

class AboutusModel extends Model
{

    public function aboutus() {

        return $this->activeDataBase();
    }
    
    public function images() {
        return $this->activeDataBase();
    }
    
    public function aboutusForm()
    {
        $labels = [
            'logotext' => 'Верхний большой текст',
            'maintext'=>'Остальной текст',
        ];
        $rules = [
            /*
            'required' => [
                ['name'],
                ['short_name'],
            ],
             */
        ];
        return $this->activeForm('aboutus',$rules, $labels);
    }
    
    public function uploadFiles()
    {
        return $this->upload();
    }
    
    public function uploadRules()
    {
        return [
            // имя в форме откуда придут файлы => [массив правил]
            'images' => [
                'name' => [['replace'=>true], 'aboutus'], // изменяет имя файла, 'replace' = true|false - заменяет имя полностью | добавляет в начало
                'skipOnEmpty' => true,              // пропустить если поле пустое
                'extensions' => 'png,jpg,gif',      //доступные расширения (если пуст или отсутствует - принимает все файлы)
                'path' => '/omgfolder',             // путь для загрузки файлов(если пуст - загружает в корневую папку /uploads)
                'size' => '2mb',                  // макс размер файла (только целое число)
                'maxFiles' => 1,                  // макс кол-во файлов (0 или пустая строка - все файлы)
            ],
        ];
    }
    
}
