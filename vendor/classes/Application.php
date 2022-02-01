<?php

use dtw\AppProperties;
use errors\ErrorHandler;
use errors\NotFoundException;
use dtw\Cookies;

class Application
{
    /*
     * @array $config
     * массив конфигурации приложения
     * */
    protected $config=[];

    /*
     * @array $params
     * разобранный массив параметров, пришедших из строки запроса
     * */
    public $params=[];

    /*
     * @string $controllerName
     * Имя текущего контроллера
     * */
    public $controllerName = '';

    public function __construct($config = [])
    {
        if ( !empty($config) ) $this->config = $config;

        date_default_timezone_set('Europe/Kiev');

        //$rootFolder = '/'.explode('/', $_SERVER['PHP_SELF'])[1];
        define('_rootDIR_', $_SERVER['DOCUMENT_ROOT'].$rootFolder);  // подключить скрипты
        define('_CLASSES_', $_SERVER['DOCUMENT_ROOT'].$rootFolder."/vendor/classes");  // подключить скрипты
        define('_ASSETS_', $_SERVER['DOCUMENT_ROOT'].$rootFolder."/vendor/assets");  // подключить скрипты

        define('_rootDIR_HTTP_', 'http://'.$_SERVER['HTTP_HOST'].$rootFolder); // для ссылок
        define('_ASSETS_HTTP_', 'http://'.$_SERVER['HTTP_HOST'].$rootFolder."/vendor/assets"); // для ссылок

        require_once _rootDIR_ . "/vendor/functions/helperFuncts.php";
        require_once _rootDIR_ . "/vendor/classes/Autoloader.php";
        
        new dtw\Autoloader($config['alias']);

        new ErrorHandler($config['errors']);
    }

    /*
     * init() метод объявляет общедоступные константы и функции
     * return void
     * */
    protected function init()
    {

        //new ErrorHandler($this->config['errors']);
    }

    /*
     * парсим строку запроса
     */
    protected function parseQueryString()
    {

        $query_string = str_replace("q=","",trim($_SERVER['QUERY_STRING']));
        $query_string = urldecode($query_string);
        $query_params = explode("/",$query_string);

        $paramIter = 0;
        if ( $this->config['multiLanguage']['enable'] )
        {
            // теперь первый элемент в запросе - это язык
            $language = $query_params[$paramIter];
            $langs = $this->config['multiLanguage']['language'];
            /*
             * на данном этапе я не могу определить "не верный" язык
             * потому что на месте 1го элемента в запросе всегда будет либо язык либо контроллер либо модуль
             * просто сверим содержимое этого элемента с массивом языков в конфиге
             * если не нашли совпадений - запишем язык по умолчанию
             */
            foreach ( $langs as $lang => $path )
            {
                if ( $language == $lang )
                {
                    AppProperties::setRout(['language'=>$query_params[$paramIter]]);
                    // когда есть совпадение прибавим 1 что б перейти к контроллеру
                    $paramIter++;
                    Cookies::set('language', $lang);
                    break;
                }
            }
            // если не нашли язык, будет значение по умолчанию
            // однако если язык есть, но не верный, итерации $paramIter не будет
            // т.е язык станет контроллером, скрипт выдаст ошибку 500
            // используйте правильный язык!!!

            /* так же надо записать язык в куки
             * и брать его оттуда если не нашли язык
             * а если в куках нет, тогда брать дефолтный
             */
            if ( $paramIter == 0 )
            {
                $defLanguage = Cookies::getOne('language');
                if ( !$defLanguage )
                {
                    $defLanguage = $this->config['multiLanguage']['default'];
                    AppProperties::setRout(['language'=> $defLanguage]);
                    Cookies::set('language', $defLanguage);
                } else {
                    AppProperties::setRout(['language'=>$defLanguage]);
                }
            }

            //debug(Cookies::getCookies(),'',1);
        }

        $this->controllerName = empty($query_params[$paramIter]) ? $this->config['baseController'] : $query_params[$paramIter];
        if ( empty($this->controllerName) ) throw new NotFoundException('Никакой контроллер не найден');
        $this->controllerName = ucfirst($this->controllerName);
        AppProperties::setRout(['controller'=>$this->controllerName]);

        $paramIter++;

        for( $i = $paramIter; $i < count($query_params); $i++ )
        {

            if ($query_params[$i] != "" )
            {
                $this->params[$query_params[$i]] = $query_params[$i+1];
                $i++;
            }

        }

        //debug($this->params,'$this->params',1);
    }

    public function setAppProperties()
    {
        AppProperties::setConfig($this->config);
        AppProperties::setParams($this->params);
        AppProperties::setControllerName($this->controllerName);
    }

    protected function getController()
    {

        $this->parseQueryString();
        $this->setAppProperties();

        $class = 'controllers\\'.$this->controllerName.'Controller';

        if ( file_exists( _rootDIR_ .'/'. str_replace('\\','/', $class) . '.php' ) )
        {
            $controller = new $class();
        } else {
            /* если нет контроллера ищем в модулях */
            $class = $this->getModule();

            AppProperties::addConfig(['moduleUsed' => true]);

            try {
                $controller = new $class();
                //throw new NotFoundException("Контроллер ". $class ." не найден!");
            } catch (NotFoundException $e)
            {
                debug($e);
            }
        }


        if ( method_exists($controller, 'action') )
        {
            $controller->action();
        } else {
            throw new Exception("Метод action() не найден в контроллере ". $this->controllerName ."!", 503 );
        }
    }

    /*
     * если не найдет файл контроллера по его имени
     * пойдет искать в модули
     */
    protected function getModule()
    {
        if ( !isset($this->config['modules']) ) return null;
        $class = $this->controllerName;

        /* $this->controllerName = теперь имя модуля */

        foreach ( $this->config['modules'] as $module => $config )
        {
            if ( strtolower($module) === strtolower($this->controllerName) )
            {
                AppProperties::setRout(['module'=>$module]);

                /* теперь пытаемся найти контроллер для этого модуля */
                if ( isset($config['defaultController']) ) $defControllerName = ucfirst($config['defaultController']);
                $first = array_key_first($this->params);
                $this->controllerName = empty($first) ? $defControllerName : ucfirst($first);
                AppProperties::setRout(['controller'=> $this->controllerName]);

               $this->assortParams();

                $alias ="modules\\$module";
                if ( array_key_exists($config['alias'], $this->config['alias']) )
                {
                    $alias = $config['alias'];
                }
                if ( isset($config['layout']) )
                {
                    AppProperties::setRout(['layout'=> $config['layout']]);
                }

                $class = "$alias\controllers\\".$this->controllerName.'Controller';
                break;
            }
        }
        return $class;
    }
    /*
     * нужна если подключаем модули
     * удаляет первый параметр
     * перемещает ключи => значения
     */
    private function assortParams()
    {
        $res = [];
        $savParam = [];
        $savVal = [];
        foreach ( $this->params as $param => $value )
        {
            $savParam[] = $param;
            $savVal[] = $value;
        }
        array_shift($savParam);
        for ( $i = 0; $i < count($savVal); $i++ )
        {
            if ( !empty($savVal[$i]) ) $res[$savVal[$i]] = $savParam[$i];
        }

        $this->params = $res;
        AppProperties::setParams($res);
    }

    public function run()
    {
        $this->init();
        $this->getController();
    }
}