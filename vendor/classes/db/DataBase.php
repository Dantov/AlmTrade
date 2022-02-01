<?php

namespace dtw\db;

use dtw\AppProperties;

/*
 * Базовый класс БД
 * соединяет, разъединяет, проверяет подключение.
 */
class DataBase
{
    private static $mysqli;

    private static $host;
    private static $dbname;
    private static $username;
    private static $password;
    private static $charset;

    protected static function getDBConfig()
    {
        if ( !empty($db = AppProperties::getConfig()['db']) )
        {
            if ( isset($db['dsn']) ) self::$host = $db['dsn'];
            if ( isset($db['dbname']) ) self::$dbname = $db['dbname'];
            if ( isset($db['username']) ) self::$username = $db['username'];
            if ( isset($db['password']) ) self::$password = $db['password'];
            if ( isset($db['charset']) ) self::$charset = $db['charset'];
        }
    }

    /*
     * попытка подключения к БД
     * return true| array[errors]
     */
    public static function connect()
    {
        if ( self::isConnected() ) return self::$mysqli;

        self::getDBConfig();
        self::$mysqli = new \mysqli(self::$host, self::$username, self::$password, self::$dbname);

        /* проверка соединения */
        if (self::$mysqli->connect_errno) {
            return [
                'message' => "Не удалось подключиться!",
                'error' => self::$mysqli->error,
                'errno' => self::$mysqli->errno,
            ];
        }
        if (!self::$mysqli->set_charset(self::$charset)) {
            return [
                'message' => "Ошибка при загрузке набора символов!",
                'error' => self::$mysqli->error,
                'errno' => self::$mysqli->errno,
            ];
        }

        return self::$mysqli;
    }

    /*
     * проверяем есть ли соединение с БД
     */
    public static function isConnected()
    {
        if ( !is_object(self::$mysqli) ) return false;

        if (self::$mysqli->ping())
        {
            return true;
        } else {
           return false;
        }
    }

    /*
     * закрываем соед.
     */
    public static function closeConnection()
    {
        if ( !self::isConnected() ) return false;

        if ( self::$mysqli->close() ) {
            self::$mysqli = null;
            return true;
        } else {
            return false;
        }
    }

}