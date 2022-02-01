<?php

namespace dtw;


class Uploader
{

    private $uploadRules;
    private $files;
    private $uploadedFiles;

    public function __construct( $uploadedFiles, $files, $uploadRules )
    {
        $this->files = $files;
        $this->uploadedFiles = $uploadedFiles;
        $this->uploadRules = $uploadRules;
    }

    /*
     * проверка кроличества
     */
    private function setAmount($arr, $rule)
    {
        $filesCount = count($arr);
        if ( isset($rule) && !empty($rule) )
        {
            if ( $filesCount > (int)$rule ) $filesCount = (int)$rule;
        }
        return $filesCount;
    }
    /*
     * проверка имени
     */
    private function validateFileName($name, $rule)
    {
        $result = [];
        $info = new \SplFileInfo($name);

        $baseName = pathinfo( strtolower($info->getFilename()), PATHINFO_FILENAME );

        $validName = str_replace(Validator::$badChars,'', $baseName);
        
        switch ($rule[0]['replace'])
        {
            case 'true':
                $validName = $rule[1].time();
                break;
            case "begin":
                $validName = $rule[1].$validName;
                break;
            case "end":
                $validName = $validName.$rule[1];
                break;
            case "random":
                $validName = $validName.'_'.randomStringChars('en',6,'symbols');
                break;
        }
        return $validName;
    }

    /*
     * проверка расширения
     */
    private function validateExtension($name, $rule)
    {
        $info = new \SplFileInfo($name);
        if ( $info->isExecutable() ) return false;

        $extension = pathinfo( strtolower($info->getFilename()), PATHINFO_EXTENSION);

        if ( isset($rule) && !empty($rule) )
        {
            if ( stristr($rule, $extension) === false ) return false;
        }

        return str_replace(Validator::$badChars,'', $extension);
    }
    /*
     * проверка пути
     */
    private function validatePath($rule)
    {
        $path = trim($rule,'/\\ .');
        if ( empty($path) )
        {
            $path = _rootDIR_ . "/uploads";
            if ( !file_exists($path) ) mkdir($path,0777, true);
        }
        else
        {
            if ( stristr($path,_rootDIR_) )
            {
                if ( !file_exists($path) ) mkdir($path,0777, true);
            }
            else
            {
                $path = _rootDIR_ ."/". $path;
                if ( !file_exists($path) ) mkdir($path,0777, true);
            }
        }
        return $path;
    }

    public function saveAs($userPath='')
    {
        $res = [];

        $uploadedFiles = $this->uploadedFiles;
        if ( empty($uploadedFiles) ) $uploadedFiles = $this->files;

        //debug($uploadedFiles,'$uploadedFiles');

        foreach ( $uploadedFiles as $formName => $files )
        {
            if ( !array_key_exists($formName, $this->uploadRules) )
            {
                $rules = $this->defaultUploadRules();
            } else
            {
                $rules = $this->uploadRules[$formName];
            }

            //debug($rules,'$rules');

            $filesCount = $this->setAmount($files['name'], $rules['maxFiles']);

            for ( $i = 0; $i < $filesCount; $i++ )
            {
                $fullName = null;
                $name = $files['name'][$i];
                $tmp_name = $files['tmp_name'][$i];
                $type = $files['type'][$i];
                $size = $files['size'][$i];
                $error = $files['error'][$i];

                if ( !empty($error) )
                {
                    $res[$i]['error'] = $error;
                    continue;
                }
                if ( $rules['skipOnEmpty'] === true ) if ( empty($name) ) continue;

                /*
                 * проверка размера
                 */
                if ( !$this->checkFileSize($size, $rules['size']) )
                {
                    $res[$i]['error'] = "file size not valid ($name). Max allowed size {$rules['size']}";
                    continue;
                }
                /*
                 * проверка имени и расширения
                 */
                $validName = $this->validateFileName($name, $rules['name']);

                if ( !$validExtension = $this->validateExtension($name, $rules['extensions']) )
                {
                    $res[$i]['error'] = "Extension not valid ($name)";
                    continue;
                }

                /*
                 * проверка пути
                 */
                if ( empty($userPath) )
                {
                    $path = $this->validatePath($rules['path']);
                } else {
                    $path = $this->validatePath($userPath);
                }

                $fullName = "$path/$validName.$validExtension";

                if ( move_uploaded_file($tmp_name, $fullName) )
                {
                    $res[$i]['path'] = $path;
                    $res[$i]['name'] = "$validName.$validExtension";
                    $res[$i]['upload'] = 'success';
                    $res[$i]['error'] = "";
                } else {
                    $res[$i]['path'] = $fullName;
                    $res[$i]['error'] = 'Uploading error';
                }
            }

        }
        return $res;
    }

    /*
     *
     * return true|false
     */
    private function checkFileSize($fileSize, $rule)
    {
        if ( !isset($rule) || empty($rule) ) return true;

        $number = (int)$rule;
        $str = $rule;
        $str = str_replace(['.',',',' '], '',$str);

        $cnt = (int)$str ? strlen((int)$str) : 0;

        $mbbb = trim(substr($str,$cnt),'0');

        $arBytes = [
            [
                "UNIT" => "TB",
                "VALUE" => pow(1000, 4)
            ],
            [
                "UNIT" => "GB",
                "VALUE" => pow(1000, 3)
            ],
            [
                "UNIT" => "MB",
                "VALUE" => pow(1000, 2)
            ],
            [
                "UNIT" => "KB",
                "VALUE" => 1000
            ],
            [
                "UNIT" => "B",
                "VALUE" => 1
            ],
        ];
        $bytes = null;
        foreach ( $arBytes as $arr )
        {
            if ( $arr['UNIT'] == mb_strtoupper($mbbb) )
            {
                $bytes = $number * $arr['VALUE'];
            }
        }
        if ( (int)$fileSize > $bytes ) return false;
        return true;
    }

    /*
     * заполняется непосредствеено в модели контроллера
     * вернет массив правил вида
     * // имя в форме откуда придут файлы => [массив правил]
     * ['formField' => [rules]]
     */

    private function defaultUploadRules()
    {
        return [
            'name' => [['replace'=>false], ''],   // изменяет имя файла, 'replace' = true|"begin"|"end" - заменяет имя полностью|добавляет в начало|конец
            'skipOnEmpty' => false,              // пропустить если поле пустое
            'extensions' => '',                 //доступные расширения (если пуст или отсутствует - принимает все файлы)
            'path' => 'uploads',                // путь для загрузки файлов(если пуст - загружает в корневую папку /uploads)
            'size' => '20mb',                  // макс размер файла (только целое число)
            'maxFiles' => 20,                  // макс кол-во файлов (0 или пустая строка - все файлы)
        ];
    }

}