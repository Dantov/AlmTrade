<?php

namespace dtw;

class ActiveForm
{

    /*
     * @var array $fields - массив инпутов
     */
    protected $fields;
    /*
     * имя  name attribute
     */
    protected $nameAttr;
    /*
     * параметры тегов
     */
    protected $parameters=[];
    /*
     * имя формы
     */
    protected $formName;

    /*
     * @var bool, если $isFile === true добавляет к тегу формы enctype="multipart/form-data"
     */
    protected $isFile = false;
    /*
     * свойстви для label
     */
    protected $hasLabel=false;
    protected $labelName;
    protected $labelParameters=[];
    protected $enclosedByLabel=false;

    protected $savedParams=[];
    public function __toString()
    {
        // __toString cannot throw exception
        // use trigger_error to bypass this limitation
        return $this->render();

//        try {
//            return $this->render();
//        } catch (\Exception $e) {
//            ErrorHandler::convertExceptionToError($e);
//            return '';
//        }
    }

    /*
     * приводит
     */
    public function render()
    {
        $res = '';
        $paramsStr = "";
        $label = '';
        $lParamsStr = '';
        $closeLabel = '';
        $closeTag = "";
        $openTag = "";

        foreach ( $this->parameters as $param => $value )
        {
            if ( $this->fields == 'textarea' && $param == 'value' ) continue;
            $paramsStr .= $param.'="'.$value.'" ';
        }

        //unset($value);
        $value = '';
        if ( isset($this->parameters['value']) ) $value = $this->parameters['value'];
        switch ($this->fields)
        {
            case "input":
                $openTag = "<input ";
                $closeTag = ">";
                break;
            case "textarea":
                $openTag = "<textarea ";
                $closeTag = ">$value</textarea>";
                break;
            case "button":
                $openTag = "<button ";
                $closeTag = ">$value</button>";
                break;
        }

        /*
         * настройки Labels
         */
        if ( $this->hasLabel )
        {
            $label = '';
            $lParamsStr = '';
            $closeLabel = '';
            if ( isset($this->labelName) ) $label = '<label ';
            if ( isset($this->labelParameters) )
            {
                foreach ( $this->labelParameters as $lParam => $lValue )
                {
                    $lParamsStr .= $lParam.'="'.$lValue.'" ';
                }
                $label .= $lParamsStr;
            }

            if ( $this->enclosedByLabel === false )
            {
                $label .= '>'.$this->labelName.'</label>';
            } elseif ( $this->enclosedByLabel === true ) {
                $label .= '>'.$this->labelName;
                $closeLabel = '</label>';
            }
        }
        //$helperBlockStyle = 'style="width: 100%; padding: 3px 12px; font-size: 14px;"';
        //$helperBlock = '<div '.$helperBlockStyle.' class="error-block '.$this->parameters['id'].'"></div>';
        $res = $label . $openTag . $paramsStr . $closeTag . $closeLabel;
        //$res .= $helperBlock;

        return $res;
    }
    /*
     * создает поле в теге формы с заданными параметрами
     * @param object $model - общий набор правил для таких полей ( найдет в $attribute )
     * @param string $attribute - имя аттрибута name
     * если далее по цепочке ничего не вызвано - создаст поле с типом ТексТ
     * вернет ссылку на этот объект
     * return $this
     * */
    public function field($model, $attribute='', $table='') {

        $this->parameters = '';
        $this->fields = '';
        $this->labelName = '';
        $this->labelParameters = '';
        $this->hasLabel = false;

        if ( !is_object($model) || empty($model) ) throw new \Exception('Модель не найдена',500);
        if ( !empty($table) && is_string($table) )
        {
            $this->formName = $table;
        } else {
            $this->formName = $model->formName;
        }

        if ( !empty($attribute) )
        {
            $this->parameters['name'] = $this->formName."[$attribute]";
            $this->parameters['id'] = $this->formName."-$attribute";
        }

        foreach ( $model as $opt => $value )
        {

            switch ($opt) {
                case 'rules':
                    if ( array_key_exists($attribute, $value) )
                    {
                        $rules = $value[$attribute];
                        foreach ( $rules as $rule => $val )
                        {
                            if ( is_array($val) )
                            {
                                switch ( $rule )
                                {
                                    case "length":
                                        //$this->parameters['required'] = "";
                                        break;
                                }
                                //тогда $rule - ключ
                            }
                            // в остальных случаях $rule - правило! (значение)
                            switch ( $rule )
                            {
                                case "required":
                                    //$this->parameters['required'] = "";
                                    break;
                                case "email":
                                    // ваоидация email
                                     //Validator::emailValidation('mail');
                                    break;
                            }
                        }
                    }
                    break;
                case 'attributeLabels':
                    if ( array_key_exists($attribute, $value) )
                    {
                        $labelName = $value[$attribute];
                        $this->hasLabel = true;
                        $this->labelName = $labelName;
                        $this->labelParameters['for'] = $this->parameters['id'];
                    }
                    break;
            }

        }

        $this->parameters['type'] = 'text';
        $this->fields = "input";

        return $this;
    }

    public function input($type='', $attributes=[], $enclosedByLabel=false)
    {
        if ( !empty($type) ) $this->parameters['type'] = $type;
        $this->fields = "input";

        if ( !empty($attributes) ) $this->setParameters($attributes);

        $this->enclosedByLabel = $enclosedByLabel;
        return $this;
    }

    public function textarea($attributes=[], $enclosedByLabel=false)
    {
        unset($this->parameters['type']);// = 'textarea';
        $this->fields = "textarea";

        if ( !empty($attributes) ) $this->setParameters($attributes);

        $this->enclosedByLabel = $enclosedByLabel;
        return $this;
    }
    /*
     * отрисовка кнопки button
     */
    public function button($attributes=[]) {

        $this->parameters['type'] = 'button';
        $this->fields = "button";

        if ( !empty($attributes) ) $this->setParameters($attributes);

        return $this;
    }
    public function submitButton($attributes=[]) {

        $this->parameters['type'] = 'Submit';
        $this->fields = "button";

        if ( !empty($attributes) ) $this->setParameters($attributes);
        return $this;
    }

    public function radio($attributes=[], $enclosedByLabel=false)
    {
        $this->parameters['type'] = 'radio';
        $this->fields = "input";

        if ( !empty($attributes) ) $this->setParameters($attributes);
        $this->enclosedByLabel = $enclosedByLabel;

        return $this;
    }

    public function checkbox($attributes=[], $enclosedByLabel=false)
    {
        $this->parameters['type'] = 'checkbox';
        $this->fields = "input";

        if ( !empty($attributes) ) $this->setParameters($attributes);
        $this->enclosedByLabel = $enclosedByLabel;

        return $this;
    }

    public function file( $multiple, $attributes=[], $enclosedByLabel=false)
    {
        HtmlHelper::setEnctype("multipart/form-data");

        if ( (bool)$multiple )
        {
            $this->parameters['multiple'] = '';
            $this->parameters['name'] .= "[]";
        }

        $this->parameters['type'] = 'file';
        $this->fields = "input";

        if ( !empty($attributes) ) $this->setParameters($attributes);
        $this->enclosedByLabel = $enclosedByLabel;

        return $this;
    }

    /*
     * @param array $options - позиция лейбла, инпут внутри или снаружи, и др.
     * @param string $id - для связи с инпутом
     * */
    public function label($label, $options=[])
    {
        $this->hasLabel = true;
        if ( !empty($label) ) $this->labelName = $label;
        $this->labelParameters['for'] = $this->parameters['id'];

        if ( !empty($options) ) $this->setParameters($options);

        return $this;
    }

    private function setParameters($params)
    {
        $funct = debug_backtrace()[1]['function'];
        if ( is_array($params) )
        {
            foreach ( $params as $key => $param )
            {
                if ( $funct == "label" )
                {
                    $this->labelParameters[$key] = $param;
                } else {
                    $this->parameters[$key] = $param;
                }
            }
        }
    }

}