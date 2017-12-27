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

    public static function albums($page=1)
    {
        Model::Init();
        if (Model::$can_connect) {

            view\View::startPage(30, "ESIMAT | Album", self::getUrlUser(), "noImage");
            view\View::header(30);

            $data = array(
                array("id" => 1, "title" => "album 1", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "12/12/2012"),
                array("id" => 2, "title" => "album 8", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "12/12/2012"),
                array("id" => 3, "title" => "album 2", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "12/12/2012"),
                array("id" => 1, "title" => "album 3", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "12/12/2012"),
                array("id" => 2, "title" => "album 4", "image" => "g1.jpg", "description" => "bla bla bla  blabla bla blabla bla b blabla bla blabla bla b blabla bla blabla bla b", "date_post" => "12/12/2012"),
                array("id" => 3, "title" => "album 6", "image" => "g1.jpg", "description" => "bla blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla", "date_post" => "12/12/2012")
            );
            view\Album::albumsPagin($data, 1, $page, 10);
            view\View::endPage();
        }
    }

    public static function album($id)
    {
        Model::Init();
        if (Model::$can_connect) {

            view\View::startPage(31, "ESIMAT | Album", self::getUrlUser(), "noImage",['lightcase.css']);
            view\View::header(31);

            $data = array(array("image"=>"g4.jpg","title"=>"Titre 1"),
                array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4"),
            array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4") ,
            array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4")
                );
            view\Album::imagesAlbum($data,"le premier evenment",$id,"Cette evenement est ...");
            view\View::endPage(['lightcase.js','jquery.events.touch.js','diapo.js']);
        }
    }



//remarque
/*
 * on peut mettre le header dans la metthod start_page dans (class use app\view\view) mais pour
 * le moment on sépare pour avoir une vue logique...
 */




}