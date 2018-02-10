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
            view\View::startPage(0, 'home', [], $_SESSION, Model::getNotViewMessages());
            view\Home::showHome(Model::getHomeState());
            view\View::endPage();
        }
    }
    public static function formPostTopic()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(10, 'Publier un article', [], $_SESSION, Model::getNotViewMessages());
            view\Topic::showTopicForm();
            view\View::endPage(['kikim_progress.js', 'api.js', 'topic.js']);
        }
    }
    public static function formPostAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(20, 'Publier un album', [], $_SESSION, Model::getNotViewMessages());
            view\Album::showAlbumForm();
            view\View::endPage(['kikim_progress.js', 'api.js', 'album.js']);
        }
    }
    public static function formPostFile()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(30, 'Publier un fichier', [], $_SESSION, Model::getNotViewMessages());
            view\File::showFileForm();
            view\View::endPage(['kikim_progress.js', 'api.js', 'file.js']);
        }
    }
    /****post*****/
    public static function postTopic()
    {
        $topic = UploadData::uploadTopic();
        if ($topic['addIt']) {
            Model::init();
            if (Model::$can_connect) {
                $id = Model::addTopic($topic['data']);
                view\View::showJson(array("upload" => true, "id" => $id));
            }
        } else {
            view\View::showJson(array("upload" => false, "message" => ($topic['data'])));
        }
    }
    public static function postAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            $album = UploadData::uploadAlbum();
            if (!empty($album['add'])) {
                $id = Model::creatAlbum($album['data']);
                view\View::showJson(array("upload" => true, "id" => $id));
            } else {
                view\View::showJson(array("upload" => false, "message" => ($album['data'])));
            }
        }
    }
    public static function postFile()
    {
        Model::init();
        if (Model::$can_connect) {
            $file = UploadData::uploadFile();
            if (!empty($file['add'])) {
                $id = Model::creatFile($file['data']);
                view\View::showJson (array("upload" => true, "id" => $id));
            } else {
                view\View::showJson(array("upload" => false, "message" => ($file['data'])));
            }
        }
    }
    /****list*****/
    public static function listTopics()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(10, 'Liste des articles', [], $_SESSION, Model::getNotViewMessages());
            $topics = Model::getAdminTopics();
            view\Topic::showTopics($topics);
            view\View::endPage(['kikim_progress.js', 'api.js', 'topic.js']);
        }
    }
    public static function listAlbums()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(20, 'Liste des albums', [], $_SESSION, Model::getNotViewMessages());
            $albums = array();
            view\Album::showAlbums($albums);
            view\View::endPage(['kikim_progress.js', 'api.js', 'album.js']);
        }
    }
    public static function listFiles()
    {
        Model::init();
        if (Model::$can_connect) {
            view\View::startPage(30, 'Liste des fichiers', [], $_SESSION, Model::getNotViewMessages());
            $files = array();
            view\File::showFiles($files);
            view\View::endPage(['kikim_progress.js', 'api.js', 'album.js']);
        }
    }

    public static function deleteTopic()
    {
        Model::init();
        if (Model::$can_connect) {
            if( !empty($_POST['id'])&&(int)$_POST['id']==$_POST['id'])
            {
                Model::deleteTopic((int)$_POST['id']);
                view\View::showJson(array("delete"=>true));
            }
            else
            {
                view\View::showJson(array("delete"=>false,"message"=>"Paramètre non valide"));
            }
        }
    }

    public static function deleteAlbum()
    {
        Model::init();
        if (Model::$can_connect) {
            if( !empty($_POST['id'])&&(int)$_POST['id']==$_POST['id'])
            {
                Model::deleteAlbum((int)$_POST['id']);
                view\View::showJson(array("delete"=>true));
            }
            else
            {
                view\View::showJson(array("delete"=>false,"message"=>"Paramètre non valide"));
            }
        }
    }

    public static function deleteFile()
    {
        Model::init();
        if (Model::$can_connect) {
            if( !empty($_POST['id'])&&(int)$_POST['id']==$_POST['id'])
            {
                Model::deleteFile((int)$_POST['id']);
                view\View::showJson(array("delete"=>true));
            }
            else
            {
                view\View::showJson(array("delete"=>false,"message"=>"Paramètre non valide"));
            }
        }
    }
    public static function deleteMessage()
    {
        Model::init();
        if (Model::$can_connect) {
            if( !empty($_POST['id'])&&(int)$_POST['id']==$_POST['id'])
            {
                Model::deleteMessage((int)$_POST['id']);
                view\View::showJson(array("delete"=>true));
            }
            else
            {
                view\View::showJson(array("delete"=>false,"message"=>"Paramètre non valide"));
            }
        }
    }

    public static function showAdmins()
    {
        Model::init();
        if (Model::$can_connect) {
        view\View::startPage(0,'Admins',[],$_SESSION);
        view\Admin::showAdmins(Model::getAdmins());
        view\View::endPage();

        }
    }

}