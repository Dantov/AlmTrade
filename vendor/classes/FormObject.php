<?php

namespace dtw;

class FormObject
{

    /*
     * @var array $rules
     */
    protected $rules;
    /*
     * @var array $errors
     */
    protected $errors;
    /*
     * @var array $data - загруженные данные из формы, которые соответствуют этой табл.
     */
    protected $data;
    /*
     * @var array $labels - лейблы полей в форме
     */
    public $labels;
    /*
     * @var string  formName имя полей в форме
     */
    public $formName;


    public function __isset($name)
    {
        return isset($this->$name);
    }
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get( $name )
    {
        //return "";
        return "Can't find property <b>$name</b>";
    }

    public function __construct($vars)
    {

        foreach ( $vars as $cvar => $val ) {
            $this->$cvar = $val;
        }
        //debug($this->formName,'$this->formName123');
        $this->load();

    }

    protected function load()
    {
        //debug($_POST[$this->formName],'$_POST->formName');
        if ( isset($_POST[$this->formName]) )
        {
            $this->data = $_POST[$this->formName];
        }
        //debug($this->data,'$this->data');
    }

    public function validate()
    {
        $v = Registry::instance()->getObj('validator');
        $v->rules($this->rules);
        $v->setData($this->data);
        if ( $v->validate() ) return $this->data;

        $this->errors = $v->errors();
        return false;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}