<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 22:14
 */

namespace admin\src\view;
use app\Glob;


class Connexion
{

    public static function showConnexion($key)
    {
        echo "form de connexion ! key=$key <br> Domain ".Glob::DOMAIN;
    }
}