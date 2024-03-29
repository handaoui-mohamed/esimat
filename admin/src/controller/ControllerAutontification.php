<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 20:08
 */

namespace admin\src\controller;


class ControllerAutontification
{

    private static $connect=false;

    private static $expireSession=false;

    private static function withSession()
    {
        return !empty($_SESSION['time_connection']) &&
               !empty($_SESSION['admin_connect']) &&
               !empty($_SESSION['role']);
    }

    public static function killAll()
    {
        $_SESSION=array();
    }

    public static function ditecteAutorisation()
    {
        if (self::withSession())
        {
            if (time()<$_SESSION['time_connection']+3600)
            {
                self::$connect=true;
            }
            else
            {
                self::killAll();
                self::$expireSession=true;
            }
        }
        else
        {
            $_SESSION['admin_connect']=false;
            $_SESSION['time_connection']=0;
            self::$connect=false;
        }

    }

    /**
     * @return bool
     */
    public static function isConnect()
    {
        return self::$connect;
    }

    /**
     * @return bool
     */
    public static function isExpireSession()
    {
        return self::$expireSession;
    }


}