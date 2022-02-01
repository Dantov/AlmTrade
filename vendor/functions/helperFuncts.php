<?php

/*
 * @var $str string - строка выведется перед переменной
 * print array|variable|object
 */
function debug( $arr, $str = false , $die = 0)
{
    echo '<pre>';
    if ( $str ) echo $str . ' = ';
    print_r( $arr );
    echo '</pre>';

    if ( $die ) die;
}

/**
 * Gets the first key of an array
 */
if (!function_exists('array_key_first')) {
    function array_key_first($array)
    {
        if (count($array)) {
            reset($array);
            return key($array);
        }

        return null;
    }
}
/*
 * генератор случайной строки
 * @var string $language - ru|en
 * @var number $length - желаемая длинна
 *
 * @var string $method - метод генерации символов
 * all - все доступные символы;
 * symbols - буквы и цифры;
 * chars - только буквы;
 * numbers - только цифры;
 * return string
 */
function randomStringChars( $language='en', $length=null, $method='chars' )
{
    $numbers = '0123456789';
    $symbols = '!@#№$%^&?_=+,-^:;{}[]';
    $charsRu = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'. strtoupper('абвгдеёжзийклмнопрстуфхцчшщъыьэюя');
    $charsEn = 'abcdefghijklmnopqrstuvwxyz'. strtoupper('abcdefghijklmnopqrstuvwxyz');

    $mixedCharsEn = '';
    $mixedCharsRu = '';

    /* если в параметрах передали только число - то это будет длинна строки */
    if ( func_num_args() == 1 )
    {
        $arg = func_get_args();
        if ( is_int($arg[0]) ) $length = $arg[0];
    }

    switch ($method)
    {
        case "all":
            $mixedCharsEn = $charsEn.$numbers.$symbols;
            $mixedCharsRu = $charsRu.$numbers.$symbols;
            break;
        case "symbols":
            $mixedCharsEn = $charsEn.$numbers;
            $mixedCharsRu = $charsRu.$numbers;
            break;
        case "chars":
            $mixedCharsEn = $charsEn;
            $mixedCharsRu = $charsRu;
            break;
        case "numbers":
            $mixedCharsEn = $numbers;
            $mixedCharsRu = $numbers;
            break;
    }
    if (!function_exists('setChars')) {
        function setChars( $chars )
        {
            $characters = $chars;
            $characters = preg_split( '//u', $characters, -1, PREG_SPLIT_NO_EMPTY );
            shuffle( $characters );
            return implode( $characters );
        }
    }
    switch ($language)
    {
        case 'ru':
            $characters = setChars($mixedCharsRu);
            break;
        case 'en':
            $characters = setChars($mixedCharsEn);
            break;
        default:
            $characters = setChars($mixedCharsEn);
            break;
    }
    $str = '';
    if ( !$length ) $length = mt_rand(2, iconv_strlen($characters));
    for ($i = 0; $i < $length; $i++) {
        $str .= mb_substr( $characters, mt_rand(0, iconv_strlen($characters)), 1);
    }
    return $str;
}

function randomEmail()
{
    $ext = ['ru','en','br','fr','de','me','ua','eg','lt','pl'];
    return randomStringChars(rand(4,9))."@".randomStringChars(rand(3,6)).".".$ext[rand(0,count($ext)-1)];

}