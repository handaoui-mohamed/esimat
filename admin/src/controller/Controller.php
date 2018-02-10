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
            view\View::startPage(0,'home',[],$_SESSION,Model::getNotViewMessages());
            view\Home::showHome(Model::getHomeState());
            view\View::endPage();
        }

    }

    public static function formPostTopic()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(10,'Publier un article',[],$_SESSION,Model::getNotViewMessages());
            view\Topic::showTopicForm();
            view\View::endPage(['kikim_progress.js','api.js','topic.js']);
        }
    }


    public static function formPostAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(20,'Publier un album',[],$_SESSION,Model::getNotViewMessages());
            view\Album::showAlbumForm();
            view\View::endPage(['kikim_progress.js','api.js','album.js']);
        }
    }
    public static function formPostFile()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(30,'Publier un fichier',[],$_SESSION,Model::getNotViewMessages());
            view\File::showFileForm();
            view\View::endPage(['kikim_progress.js','api.js','file.js']);
        }
    }

    /****post*****/


    public static function postTopic()
    {
        $topic=UploadData::uploadTopic();
        if ($topic['addIt'])
        {
            Model::init();
            if (Model::$can_connect) {
                $id=Model::addTopic($topic['data']);
                echo json_encode(array("upload"=>true,"id"=>$id));
            }
        }
        else
        {
            echo json_encode(array("upload"=>false,"messages"=>($topic['data'])));
        }
    }
    public static function postAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            $album=UploadData::uploadAlbum();
            if (!empty($album['add']))
            {
                $id=Model::creatAlbum($album['data']);
                echo json_encode(array("upload"=>true,"id"=>$id));
            }
            else
            {
                echo json_encode(array("upload"=>false,"messages"=>($album['data'])));
            }
        }
    }
    public static function postFile()
    {
        Model::init();
        if (Model::$can_connect) {
            $file=UploadData::uploadFile();
            print_r($file);
            if (!empty($file['add']))
            {
                $id=Model::creatFile($file['data']);
                echo json_encode(array("upload"=>true,"id"=>$id));
            }
            else
            {
                echo json_encode(array("upload"=>false,"messages"=>($file['data'])));
            }
        }
    }

    /****list*****/

    public static function listTopics()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(10,'Liste des articles',[],$_SESSION,Model::getNotViewMessages());
            $topics = array(
                array(
                    "id" => 1,
                    "title" => "topic 1",
                    "type" => 1,
                    "body" => "Bacon ipsum dolor amet alcatra doner cupim beef ribs meatloaf ham hock, pastrami sirloin pancetta andouille venison. Tri-tip prosciutto ham hock brisket frankfurter. Ground round boudin flank biltong landjaeger tongue tenderloin prosciutto. Tenderloin short ribs ground round meatloaf landjaeger ham. Turducken picanha shoulder, frankfurter jerky prosciutto bacon cupim sirloin biltong ball tip strip steak alcatra landjaeger.",
                    "date_post" => "12/12/2012"
                ),
                array(
                    "id" => 2,
                    "title" => "topic 2",
                    "type" => 1,
                    "body" => "Bacon ipsum dolor amet alcatra doner cupim beef ribs meatloaf ham hock, pastrami sirloin pancetta andouille venison. Tri-tip prosciutto ham hock brisket frankfurter. Ground round boudin flank biltong landjaeger tongue tenderloin prosciutto. Tenderloin short ribs ground round meatloaf landjaeger ham. Turducken picanha shoulder, frankfurter jerky prosciutto bacon cupim sirloin biltong ball tip strip steak alcatra landjaeger.",
                    "date_post" => "12/12/2012"
                ),
                array(
                    "id" => 3,
                    "title" => "topic 3",
                    "type" => 1,
                    "body" => "Bacon ipsum dolor amet alcatra doner cupim beef ribs meatloaf ham hock, pastrami sirloin pancetta andouille venison. Tri-tip prosciutto ham hock brisket frankfurter. Ground round boudin flank biltong landjaeger tongue tenderloin prosciutto. Tenderloin short ribs ground round meatloaf landjaeger ham. Turducken picanha shoulder, frankfurter jerky prosciutto bacon cupim sirloin biltong ball tip strip steak alcatra landjaeger.",
                    "date_post" => "12/12/2012"
                )
            );

            view\Topic::showTopics($topics);
            view\View::endPage(['kikim_progress.js','api.js','topic.js']);
        }
    }
    public static function listAlbums()
    {

    }
    public static function listFiles()
    {

    }



}