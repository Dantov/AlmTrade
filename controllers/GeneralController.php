<?php

namespace controllers;

use dtw\Controller;
use Models\ContactsModel;

class GeneralController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        
        $homeModel = new \Models\HomeModel;
        $home = $homeModel->home();
        $homeLogos = $home->findOne(['logotext'])->go();
        
        $model = new ContactsModel;
        $contact = $model->contacts();
        $contacts = $contact->findAll()->go();
        
        $phones = explode("<br>", html_entity_decode($contacts[1]->descr))[0];
        $email = explode("<br>", html_entity_decode($contacts[2]->descr))[0];
        
        $this->setVar([
            'address' => $contacts[0]->descr,
            'phones' => $phones,
            'email' => $email,
            'logotext' => $homeLogos->logotext
        ]);
    }
    
}
