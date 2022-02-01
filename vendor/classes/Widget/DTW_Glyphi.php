<?php

//namespace vendor\classes\widget;
namespace widgets;

use dtw\HtmlHelper;

/*
 * вернет представление
 * строковый элемент <span> с картинкой глификон на фоне
 */
class DTW_Glyphi extends Widget
{

    public $item = "";
    public $options = [];

    public $path = "";
    public $width = "";
    public $height = "";
    public $wrapp = "";
    public $class = "";
    public $link = "";

    public function init()
    {
        if ( isset($this->item) )
        {
            $this->item = (int) $this->item;
        } else {
            $this->item = 1;
        }

        $this->width = $this->options['size']?:20;
        $this->height = $this->options['size']?:20;

        $this->wrapp = $this->options['wrapp']?:'span';

        if ( isset($this->options['class']) )
        {
            $this->class = $this->options['class'] . " ";
        }
         if ( isset($this->options['link']) )
         {
             $link = HtmlHelper::URL($this->options['link']);
             $this->link = 'href="' . $link .'"';
             $this->wrapp = 'a';
         }

        $this->path = $this->getItem();
    }

    public static function style()
    {
        $style ='';
        $style .= self::$style;

        echo $style . '</style>';
    }

    public function run()
    {
        $this->class = 'class="' . $this->class . '"';
        //ob_start();
        $this->render(_ASSETS_ . "/glyphicons/view.php");
        //return ob_get_clean();
    }

    protected static $style = '<style type="text/css" >';
    protected static $className;

    protected function getItem()
    {
        $glypiPath = _ASSETS_ . "/glyphicons/png";
        $files = scandir($glypiPath);
        $file = '';
        foreach ($files as $name)
        {
            $number = (int) explode('-',$name)[1];
            if ( $this->item === $number )
            {
                $file = $name;
                break;
            }
        }

        self::$className = 'DTW_' . explode('.',$file)[0];
        $this->class .= self::$className;

        if ( !empty($file) ) return _ASSETS_HTTP_ . "/glyphicons/png/" . "/$file";

        return false;
    }
}