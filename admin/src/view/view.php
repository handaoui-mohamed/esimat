<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 18:56
 */

namespace admin\src\view;


class View
{
    private static function showHeader()
    {
        echo "<h1>From hedearv admin </h1><br>DOMAIN:".\app\Glob::DOMAIN;
    }

    public static function showHome($name)
    {
        echo "<h1>Vous etes dans l'homme : $name</h1>";
    }

}