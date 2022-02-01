<?php

namespace dtw;


class Sessions
{

    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;

    private $sessionState = self::SESSION_NOT_STARTED;


    protected function startSession()
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }
        return $this->sessionState;
    }

    protected function destroySession()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );

            return !$this->sessionState;
        }

        return FALSE;
    }

    public function setKey($name, $value)
    {
        $this->startSession();
        $_SESSION[$name] = $value;
        return true;
    }

    public function getKey($name)
    {
       $this->startSession();
        if ( isset( $_SESSION[$name] ) )
        {
            //$res = $_SESSION[$name];
            //unset($_SESSION[$name]);
            return $_SESSION[$name];
        }
        return false;
    }

    public function getAll()
    {
        $this->startSession();
        return $_SESSION;
    }

    public function dellKey($name)
    {
        $this->startSession();
        if ( isset( $_SESSION[$name] ) )
        {
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    }

    public function setFlash($key, $value)
    {
        if ( isset($key) && !empty($key) )
        {
            return $this->setKey($key, $value);
        }
        return false;
    }

    public function hasFlash($key)
    {
        if ( !empty($key) )
        {
            $this->startSession();

            if ( isset( $_SESSION[$key] ) ) return true;
        }
        return false;
    }

    public function getFlash($key)
    {
        if ( isset($key) && !empty($key) )
        {
            if ($res = $this->getKey($key))
            {
                $this->dellKey($key);
                return $res;
            }
        }
        return false;
    }

}