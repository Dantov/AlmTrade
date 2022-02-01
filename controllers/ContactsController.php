<?php

namespace controllers;

use dtw\Validator;
use Models\ContactsModel;

class ContactsController extends GeneralController
{

    public $title = "AlmTrade s.r.o :: Contacts";

    public function action()
    {
        if ( $this->params['sendmail'] )
        {
            $sended = $this->sendEmail();
            
            if ( $sended ) 
            {
                $this->session->setFlash("success_sended", "Mail was successfuly sended. We will contact you as soon as possible. ");
            } else {
               $this->session->setFlash("error_sended", "Error occurred when mail sending! Try again."); 
            }
            
            $this->refresh();
        }
        
        $model = new ContactsModel();
        $contact = $model->contacts();
        $mailform = $model->mailForm();
        
        $contacts = $contact->findAll()->go();
        
        $img = [
            'Addres' => '<span class="con-location"></span>',
            'Phone'   => '<span class="con-ph"></span>',
            'Email'   => '<span class="con-email"></span>',
        ];
        
        return $this->render('contacts',compact('contacts','img','mailform'));
    }
    
    public function sendEmail()
    {
        $data = $this->post;
        //debug($data,'$data',1);

        $name = Validator::validateString($data['name']);
        $email = Validator::validateString($data['email']);
        $message = Validator::validateString($data['message']);
        $subject  = Validator::validateString($data['subject']);

        if ( empty($name) || empty($email) || empty($message) || empty($subject) ) return null;

        $to  = "AlmTade s.r.o. <info@almtradesro.com>";

        $c_message = " 
        <html>
            <body>
                <p>
                   Новое сообщение от: <strong>$name</strong><br>
                </p>
                <p>$message</p>
            </body>
        </html>";

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: $name <$email>";

        
        if ( mail($to, $subject, $c_message, $headers) ) return 1;
            
        return null;
    }

}