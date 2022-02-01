<?php
namespace admin\controllers;

use dtw\Controller;
use dtw\AppProperties;

class AppAdminController extends Controller 
{
    
    public $title = 'AlmTrade :: Admin Side';
    
    public $js = [
        "/js/def.js" => "beginBody",
    ];
    
    public function __construct()
    {
        parent::__construct();

        $user = $this->session->getKey('user');

        $controller = AppProperties::getRout('controller');
        if ( !$user['authorized'] && $controller !== "LoginForm" )
        {
            $this->redirect('/almadmin/loginForm');
        }
    }
    
}
