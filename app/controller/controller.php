<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/12/2017
 * Time: 14:14
 */

namespace app\controller;
use app\view;
use app\model\Model;


class controller
{

    private static function getUrlUser()
    {
        return $_url= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    public static function index()
    {
        Model::Init();
        if (Model::$can_connect)
        {
            // TRAITEMENT ... REQUETE BDD ...

            view\View::startPage(0,"ESIMAT | HOME",self::getUrlUser(),"noImage",['flexslider.css']);
            view\View::header();
            // VUE SPECIFIQUE ...
            view\View::endPage(['jquery.flexslider.js','index.js','jquery.countup.js']);
        }
    }

    public static function echiquienne($page=1)
    {
        Model::Init();
        if (Model::$can_connect)
        {
            // TRAITEMENT ... REQUETE BDD ...

            url:
            view\View::startPage(10,"ESIMAT | Échiquienne",self::getUrlUser(),"noImage");
            view\View::header(10);
            // VUE SPECIFIQUE ...
            view\View::endPage();
        }
    }

    public static function scientifique($page=1)
    {
        Model::Init();
        if (Model::$can_connect)
        {
            // TRAITEMENT ... REQUETE BDD ...

            view\View::startPage(20,"ESIMAT | Scientifique",self::getUrlUser(),"noImage");
            view\View::header(20);
            // VUE SPECIFIQUE ...
            view\View::endPage();
        }
    }

//remarque
/*
 * on peut mettre le header dans la metthod start_page dans (class use app\view\view) mais pour
 * le moment on sépare pour avoir une vue logique...
 */




}