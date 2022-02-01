<?php

namespace widgets;

class Paginator extends Widget
{

    /*
     * @var object
     * объект паганации
     */
    public $pagination = [];
    /*
     * @var array
     */
    public $options = [];

    public $size ="";
    public $class ="";
    /*
     * @var number
     * кол-во отображаемых квадратиков пагинации
     */
    public $squaresPerPage = 10;
    /*
     * @var number
     * номера след 10(?) стр.
     */
    public $nextX_Squares = "";
    /*
     * @var number
     * номера пред. 10(?) стр.
     */
    public $prevX_Squares = "";

    public $startFromPage = 1;
    public $squarePages = "";
    public $backToPage = "";

    public function init()
    {
        if ( empty($this->pagination) || !is_object($this->pagination) ) return;

        $spp = (int)$this->options['squaresPerPage'];
        if ( !empty($spp) ) $this->squaresPerPage = $spp;

        $size = (string)$this->options['size'];
        if ( !empty($size) ) {
            switch ($size)
            {
                case "normal":
                    $this->size = "";
                    break;
                case "large":
                    $this->size = "pagination-lg";
                    break;
                case "small":
                    $this->size = "pagination-sm";
                    break;
                default:
                    $this->size = "";
                    break;
            }
        }

        $class = (string)$this->options['class'];
        if ( !empty($class) ) $this->class = $class;

        $this->startFromPage();
    }

    public function startFromPage()
    {
        $countPages = $this->pagination->countPages;
        $this->squarePages = ceil( $countPages / $this->squaresPerPage );
        $var = array_fill(0, $this->squarePages, '');

        $cP = [];
        for ( $c = 1; $c <= $countPages; $c++ )
        {
            $cP[$c] = $c;
        }
        //debug($cP,'$countPages');

        $k = 0;
        for ( $i = 0; $i < count($var); $i++ )
        {
            for ( $j = 0; $j < $this->squaresPerPage; $j++ )
            {
                $k++;
                $var[$i][] = $cP[$k];
            }
        }

        //debug($var,'$var');

        /* найдем нашу страницу в каком нибудь из полученных массивах */
        $page = $this->pagination->currentPage;
        //debug($page,'$page');
        foreach ( $var as $k => $array )
        {
            if ( in_array($page,$array) )
            {
                $first = array_key_first($array);
                $this->startFromPage = $array[$first];
                break;
            }
        }

        if ($page > $this->squaresPerPage)
        {
            $this->backToPage = $this->startFromPage - 1;
        }
        //debug($this->startFromPage,'$this->startFromPage',1);

    }

    public function run()
    {
        $this->render(_ASSETS_ . "/paginator_tpl.php");
    }

}