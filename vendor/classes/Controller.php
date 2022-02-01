<?php

namespace dtw;

use dtw\db\DataBase;
use errors\NotFoundException;

class Controller {

    /*
     * @string $title
     * задаётся в контроллере или в файле страницы
     * */
    public $title = '';

    /*
     * @string $layout
     * Название шаблона задаётся в контроллере
     * */
    public $layout = '';
    /*
     * @string $layoutPath
     * дефолтный путь к шаблону
     * */
    public $layoutPath = _rootDIR_;

    /*
     * @var $varBlock
     * $blocks = []; нужен для передачи переменных из вида в шаблон
     * */
    public $varBlock = [];
    /*
     * @var array $blocks
     * содержит блоки html кода
     */
    public $blocks = [];
    /*
     * @var array
     * содержит имена открытых блоков
     * каждый вызов endBlock() берет имя первого элемента массива
     * создает в $blocks такой же и помещает туда ob_get_clean()
     */
    protected $blockNames = [];

    /*
     * @var array массив заголовков
     * */
    public $headers;

    /*
     * @var array массив $_POST
     * */
    public $post = [];
    /*
     * @var array массив $_FILES
     */
    public $files = [];

    /*
     * @var $sessions object - содержит методы для работы с сессиями
     */
    public $session;

    /*
     * свойства для авторизации
     */
    public $isGuest;
    public $isUser;
    public $isAdmin;

    /*
     * @Obj $App
    * Здесь содержатся внешние свойства объект приложения
    * */
    private $config = [];
    public $params = [];
    public $controllerName = '';

    /*
     * массив подключчаемых css для этого контроллера
     */
    public $css = [];
    /*
     * массив подключчаемых js для этого контроллера
     */
    public $js = [];
    public $jsOptions = [];

    /*
     * Заполняет массив $this->post;
     * return $this->post;
     * */
    protected function post() {
        if ( !empty( $_POST ) )
        {
            if ( $this->config['csrf'] === true )
            {
                $csrf = $_POST['_csrf_'];
                if ( $_COOKIE['_csrf_'] == $csrf ) {
                    $this->post = $_POST;
                    unset($this->post['_csrf_']);
                } else {
                    $this->post = '_csrf_ not valid';
                }
            } else {
                $this->post = $_POST;
            }
        }
    }

    /*
    * загружаем файлы
    */
    public function isFiles()
    {
        if ( !empty($_FILES) ) $this->files = $_FILES;
        return $this->files;
    }

    public function __construct() {
        $this->config = AppProperties::getConfig();
        $this->params =  AppProperties::getParams();
        $this->controllerName = AppProperties::getControllerName();

        $this->getHeaders();
        $this->session = $this->setSessions();
        $this->post();
        $this->isFiles();

        // создаем пустой объект, чтобы потом дописывать туда разные св-ва
        $this->varBlock = new Obj([]);
        //self::$Model = $this->getModel();
    }

    /*
     * Подключает модель для контроллера
     * имя модели должно совпадать с именем контроллера
     *
     * return object || false
     * */
    protected function getModel()
    {
        //$name = self::$App->controllerName;
        $name = $this->controllerName;
        if ( file_exists(_rootDIR_ . "/Models/".$name."Model.php") )
        {
            $class = 'Models\\' . $name.'Model';
            return new $class( $this->post, $this->files );
        } else {
            return null;
        }
    }

    /*
     * заполняем объект для работы с сессиями
     * return object;
     */
    private function setSessions()
    {
        return new Sessions();
    }

    /*
     * setLayout()
     * Устанавливает шаблон из конфиг файла приложения, или из контроллера, если был задан в нем
     * return void
     * */
    protected function setLayout()
    {
       $moduleLayout = AppProperties::getRout('layout');
        if ( empty($this->layout) && $this->config['moduleUsed'] === true && !empty($moduleLayout) )
        {
            $this->layout = $moduleLayout;

        } elseif ( empty( $this->layout ) && isset($this->config['layout']) ) {

            $this->layout = $this->config['layout'];

        } elseif ( empty( $this->layout ) ) {

            $this->layout = 'default';
        }
    }

    /*
     * setTitle() Устанавливаем Title по умолчанию
     * return void
     * */
    public function setTitle()
    {
        if ( empty( $this->title ) )  $this->title = "Powered by Dantov's Framework";
    }

    /*
     * Вывод шаблона и страницы
     * return  renderLayout($content);
     * */
    public function render($filename, $arrVars=false)
    {
        DataBase::closeConnection();

        if ( isset($arrVars) && !empty($arrVars) ) extract($arrVars);

        $dataCompress = null;
        if ( AppProperties::getConfig()['dataCompression'] )
        {
            $dataCompress = 'ob_gzhandler';
        }

        ob_start();
        {
            //header('Content-Encoding: gzip');
            if ( $this->config['moduleUsed'] === true ) {
                $moduleName = AppProperties::getRout( 'module' );
                require_once _rootDIR_ . "/modules/$moduleName/views/" . $filename . '.php';

            } else {
                require_once _rootDIR_ . '/views/' . $filename . '.php';
            }
            $content = ob_get_contents();
        }
        ob_end_clean();

        return $this->renderLayout($content);
    }
    protected function renderLayout($content) {
        $this->setLayout();
        $this->setTitle();

        if ( $this->config['moduleUsed'] === true )
        {
            $module = AppProperties::getRout( 'module' );
            $this->layoutPath = _rootDIR_ . "/modules/$module/views/layouts/" . $this->layout . '.php';

            if ( !file_exists( $this->layoutPath ) )
            {
                throw new NotFoundException('Шаблон <i>' . $this->layout . "</i> не найден в /modules/$module/views/layouts/");
            }

        } else {
            $this->layoutPath .= '/views/layouts/' . $this->layout . '.php';
            if ( !file_exists( $this->layoutPath ) )
            {
                throw new NotFoundException("Шаблон <i>" . $this->layout . "</i> не найден в /views/layouts/");
            }
        }

        return require_once $this->layoutPath;
    }

    /*
     * Задает переменные в видах, для использования в шаблоне
     * return void
     * */
    public function setVar($vars) 
    {
        if ( !isset($vars) || empty($vars) ) return;
        if ( !is_array($vars) ) return;
        
        foreach ($vars as $key => $value) 
        {
            $this->varBlock->$key = $value;
        }
        
    }
    public function startBlock($name)
    {
        if ( empty($name) ) return;
        $name .= "";
        $this->blockNames[$name] = $name;
        ob_start();
    }
    public function endBlock()
    {
        $name = array_shift($this->blockNames);
        if ( empty($name) ) return;
        $this->blocks[$name] = ob_get_clean();
    }
    /*
     * обновить текущую старницу
     */
    public function refresh()
    {
        $module = AppProperties::getRout('module');
        $controller = AppProperties::getRout('controller');

        if ( !empty($module) ) $module .= "/";

        header('Location: ' . _rootDIR_HTTP_ .'/'. $module . $controller );
        //header('Location: ' . _rootDIR_HTTP_ .'/'. $this->controllerName );
        exit();
    }
    /*
     * переход на др. страницу
     */
    public function redirect($url='')
    {
        if ( !empty($url) ) {
            $first = substr($url, 0, 1);
            if ( $first == '/' || $first == '\\' ) {
                $url = _rootDIR_HTTP_ . $url;
            } else {
                $url = _rootDIR_HTTP_ ."/". $url;
            }
            header("Location:" . $url);

            exit();
        }
    }


    /*
     * includeLibraries($method=false)
     * Подключаем библиотеки из конфиг файла
     * return void
     * */
    private function includeLibraries($method=false) {

        $pathLib = _rootDIR_HTTP_ . '/vendor/libraries/';
        if ( isset($this->config['libraries']) ) {
            foreach ( $this->config['libraries'] as $lib => $value ) {

                switch ($lib) {
                    case 'jquery':
                        if ( $value === true ) {
                            $path = $pathLib. 'JQuery/';
                            $this->includeScripts($method, $path, ['jquery-3.2.1.min.js']);
                        }
                    break;
                    case 'bootstrap':
                        if ( $value == 'bootstrap3' ) {
                            $path = $pathLib. 'Bootstrap/v3.3.7/';
                            $this->includeCss( $path, ['bootstrap.css','bootstrap-theme.css'], $method);
                            $this->includeScripts($method, $path, ['bootstrap.js']);
                        } elseif ( $value == 'bootstrap4' ) {
                            $pathCss = $pathLib. 'Bootstrap/v4.1.3/css/';
                            $pathJs = $pathLib. 'Bootstrap/v4.1.3/js/';
                            $this->includeCss( $pathCss, ['bootstrap.css','bootstrap-grid.css','bootstrap-reboot.css'], $method);
                            $this->includeScripts($method, $pathJs, ['bootstrap.js','bootstrap.bundle.js']);
                        }
                    break;
                    case 'fontAwesome':
                        if ( $value === true ) {
                            $path = $pathLib. 'font-awesome-4.7.0/css/';
                            $this->includeCss( $path, ['font-awesome.css'], $method);
                        }
                    break;
                }

            }
        }

    }

    /*
     * Заполняет массив заголовков
     * return array - массив заголовков
     * */
    public function getHeaders()
    {
        if ($this->headers === null) {

            if (function_exists('getallheaders')) {
                $headers = getallheaders();
                foreach ($headers as $name => $value) {
                    $this->headers[$name] = $value;
                }
            } elseif (function_exists('http_get_request_headers')) {
                $headers = http_get_request_headers();
                foreach ($headers as $name => $value) {
                    $this->headers[$name] = $value;
                }
            } else {
                foreach ($_SERVER as $name => $value) {
                    if (strncmp($name, 'HTTP_', 5) === 0) {
                        $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                        $this->headers[$name] = $value;
                    }
                }
            }
        }

        return $this->headers;
    }


    /*
     * Проверяет если данные из Ajax
     * return true/false
     * */
    public function isAjax() {
        foreach ( $this->headers as $name => $val ) {
            if ( $name === 'X-Requested-With' && $val === 'XMLHttpRequest'  ) return true;
        }
        return false;
    }



    private function includeScripts($method=false, $path=false, $files=false) {
        if ( !$path ) {
            $path = _rootDIR_HTTP_ . '/views/';
            if ($this->config['jsOptions']['position'] == $method) {
                foreach ($this->config['js'] as &$js) {
                    echo "<script src=\"$path$js\"></script>"."\n";
                }
            }

            // эта ветка для подключения свойства $this->js из контроллера 
            if ( !empty($this->js) && is_array($this->js) ) {

                foreach ( $this->js as $js => $meth ) {
                    if ($meth != $method) continue;
                    $js .= "?ver=".time();
                    echo "<script src=\"$path$js\"></script>"."\n";
                }

            }

        } elseif ( $files !== false && $method !== false ) {
            foreach ( $files as $file ) {
                echo "<script src=\"$path$file\"></script>"."\n";
            }
        }

    }


    private function includeCss($path=false, $files=false, $method=false) {
        if ( $method !== false ) return; // не рисуем css если передали метод
        if ( !$path ) {
            $path = _rootDIR_HTTP_ . '/views/';
            if ( isset($this->config['css']) ) {
                foreach ( $this->config['css'] as &$css ) {
                    echo '<link rel="stylesheet" href="'.$path.$css.'">'."\n";
                }
            }
            // эта ветка для подключения свойства $this->css из конироллера
            if ( !empty($this->css) && is_array($this->css) ) {
                //debug($this->css,'$this->css');
                foreach ( $this->css as $file ) {
                    echo '<link rel="stylesheet" href="'.$path.$file.'">'."\n";
                }
            }
        } elseif ( $files !== false ) {
            foreach ( $files as $file ) {
                echo '<link rel="stylesheet" href="'.$path.$file.'">'."\n";
            }
        }
    }

    public function head() {
        $method = explode('::',__METHOD__)[1];
        $this->includeLibraries();
        $this->includeCss();
    }
    public function beginBody() {
        $method = explode('::',__METHOD__)[1];
        $this->includeScripts($method);
    }
    public function endBody() {
        $method = explode('::',__METHOD__)[1];
        $this->includeLibraries($method);
        $this->includeScripts($method);
    }

}