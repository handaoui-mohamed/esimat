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
        echo "<h1>From hedear admin </h1><br>DOMAIN:".\app\Glob::DOMAIN;
    }

    public static function showHome()
    {
        echo "@admin <hr><h1>Vous etes dans le home : </h1>";
    }

}