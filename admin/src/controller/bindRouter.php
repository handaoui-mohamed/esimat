<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 17/12/2017
 * Time: 18:29
 */

namespace admin\src\controller;



class BindRouter
{

    private static function templateController($callableWhenIsConnect)
    {
        $args=func_get_args();
        $nb_params=count($args);
        $params=array();

        for ($i=1;$i<$nb_params;$i++)
            $params[]=$args[$i];

        if (ControllerAutontification::isConnect())
        {
            call_user_func_array($callableWhenIsConnect,$params);
        }
        else
        {
            if (ControllerAutontification::isExpireSession())
            {
                // Afficher session terminée view;
            }
            else
            {
                header("location:".\app\Glob::DOMAIN);
                exit;
            }
        }

    }


    public static function home()
    {
        self::templateController("admin\src\controller\Controller::home");
    }

    /****formPost*****/
    public static function formPostTopic()
    {
        self::templateController("admin\src\controller\Controller::formPostTopic");
    }
    public static function formPostAlbum()
    {
        self::templateController("admin\src\controller\Controller::formPostAlbum");
    }
    public static function formPostFile()
    {
        self::templateController("admin\src\controller\Controller::formPostFile");
    }

    /****post*****/
    public static function postTopic()
    {
        self::templateController("admin\src\controller\Controller::postTopic");
    }
    public static function postAlbum()
    {
        self::templateController("admin\src\controller\Controller::postAlbum");
    }
    public static function postFile()
    {
        self::templateController("admin\src\controller\Controller::postFile");
    }

    /****list*****/

    public static function listTopics()
    {
        self::templateController("admin\src\controller\Controller::listTopics");
    }
    public static function listAlbums()
    {
        self::templateController("admin\src\controller\Controller::listAlbums");
    }
    public static function listFiles()
    {
        self::templateController("admin\src\controller\Controller::listFiles");
    }
    public static function deleteTopic()
    {
        self::templateController("admin\src\controller\Controller::deleteTopic");
    }

    public static function deleteAlbum()
    {
        self::templateController("admin\src\controller\Controller::deleteAlbum");
    }

    public static function deleteFile()
    {
        self::templateController("admin\src\controller\Controller::deleteFile");
    }
   public static function deleteMessage()
    {
        self::templateController("admin\src\controller\Controller::deleteMessage");
    }
    public static function showAdmins()
    {
        if (!empty($_SESSION['role'])&&$_SESSION['role']=='Administrateur')
        self::templateController("admin\src\controller\Controller::showAdmins");
        else
            die("Non autorisée");
    }






}