<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 17/12/2017
 * Time: 18:29
 */

namespace admin\src\controller;



class bindRouter
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
        self::templateController("admin\src\controller\controller::home");
    }

    /****formPost*****/
    public static function formPostTopic()
    {
        self::templateController("admin\src\controller\controller::formPostTopic");
    }
    public static function formPostAlbum()
    {
        self::templateController("admin\src\controller\controller::formPostAlbum");
    }
    public static function formPostFile()
    {
        self::templateController("admin\src\controller\controller::formPostFile");
    }

    /****post*****/
    public static function postTopic()
    {
        self::templateController("admin\src\controller\controller::postTopic");
    }
    public static function postAlbum()
    {
        self::templateController("admin\src\controller\controller::postAlbum");
    }
    public static function postFile()
    {
        self::templateController("admin\src\controller\controller::postFile");
    }

    /****list*****/

    public static function listTopics()
    {
        self::templateController("admin\src\controller\controller::listTopics");
    }
    public static function listAlbums()
    {
        self::templateController("admin\src\controller\controller::listAlbums");
    }
    public static function listFiles()
    {
        self::templateController("admin\src\controller\controller::listFiles");
    }
    public static function deleteTopic()
    {
        self::templateController("admin\src\controller\controller::deleteTopic");
    }

    public static function deleteAlbum()
    {
        self::templateController("admin\src\controller\controller::deleteAlbum");
    }

    public static function deleteFile()
    {
        self::templateController("admin\src\controller\controller::deleteFile");
    }
   public static function deleteMessage()
    {
        self::templateController("admin\src\controller\controller::deleteMessage");
    }
    public static function showAdmins()
    {
        if (!empty($_SESSION['role'])&&$_SESSION['role']=='Administrateur')
        self::templateController("admin\src\controller\controller::showAdmins");
        else
            die("Non autorisée");
    }






}