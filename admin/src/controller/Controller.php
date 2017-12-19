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
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }

    }

    public static function sience()
    {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }

    }

    public static function album()
    {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }

    }

    public static function echec()
    {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }
    }

    public static function postScience()
  {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }
  }

    public static function postEchec()
    {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }
    }


    public static function postAlbum()
    {
        Model::upConnection();
        if (Model::$can_connect)
        {
            //action
        }
    }



}