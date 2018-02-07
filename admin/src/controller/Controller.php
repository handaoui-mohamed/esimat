<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 20:29
 */

namespace admin\src\controller;

use admin\src\view;
use admin\src\model\Model;


class Controller
{
    public static function home()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
            view\View::startPage(0,'home',[],$_SESSION);
            view\Home::showHome();
            view\View::endPage();
        }

    }

    public static function science()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
            view\View::startPage();
            view\View::endPage();
        }
    }

    public static function album()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
            view\View::startPage();
            view\View::endPage();
        }

    }

    public static function echec()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
        }
    }

    public static function postScience()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
        }
    }

    public static function postEchec()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
        }
    }


    public static function postAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            //action
        }
    }

}