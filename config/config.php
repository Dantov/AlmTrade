<?php

return [
    'id' => 'almTrade',
    'basePath' => dirname(__DIR__),
    'uploadPath' => '/uploads',
    'cachePath' => '/runtime/cache',
    'baseController' => 'home',
    'layout' => 'indolence',
    'multiLanguage'=> [
        'enable' => false, // false - disable
        'language' => require_once 'languages.php', // список доступных языков
        'default' => 'en',
    ],
    'version' => '1001',
    'dataCompression' => false,
    'errors' => [
        'enable' => false, // включает перехват ошибок фреймворком DTW.  false - отключает
        'logs'   => '/runtime/logs', // false - отключает логи
        'mode'   => 0, // 1 - показ все ошибки, 0 - не показ. ошибкии, 2 - показ. нотации в жопу
    ],
    'csrf' => false, // валидация данных для форм и JS
    'classes' => [  // подключаемые классы
        'cache' => 'dtw\Cache',
        'validator' => 'libs\valitron\src\Validator',
    ],
    'modules' => [
        'almadmin' => [
            // 'alias' - здесь только имя алиаса. Путь надо указывать в aliases.php
            'alias' => 'admin', // alias namespaces for module admin
            'defaultController' => 'admin', // default route
            'layout' => 'admin_tpl',  // default layout
        ],
    ],
    'db' => [
        'dsn' => 'almtrade.mysql.tools',
        'dbname' => 'almtrade_db',
        'username' => 'almtrade_stan',
        'password' => '3h0obwdQnx13ag',
        'charset' => 'utf8',
    ],
    'libraries' => [
        //'jquery' => true,
        //'bootstrap' => 'bootstrap3',
        //'fontAwesome' => false,
    ],
    'css' => [
        'css/style2.css?ver='.time(),
    ],
    'js' => [
        //'js/scrpt.js?ver='.time(),
    ],
    'jsOptions' => [
        'position' => 'endBody',
    ],
    'alias' => require_once 'aliases.php',
];