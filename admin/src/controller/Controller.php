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
            view\View::startPage(0,'Publier un article',[],$_SESSION,Model::getNotViewMessages());
            view\Topic::showTopicForm();
            view\View::endPage(['api.js','topic.js']);
        }
    }


    public static function formPostAlbum()
    {

    }
    public static function formPostFile()
    {

    }

    /****post*****/


    public static function postTopic()
    {
           $topic=UploadData::uploadTopic();
           print_r($_POST);
           print_r($_FILES);
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

    }
    public static function postFile()
    {

    }

    /****list*****/

    public static function listTopics()
    {

    }
    public static function listAlbums()
    {

    }
    public static function listFiles()
    {

    }



}