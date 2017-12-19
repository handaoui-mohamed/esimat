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

    public static function album()
    {
        self::templateController("controller::album");
    }

    public static function echiq()
    {
        self::templateController("controller::echiq");
    }

    public static function postEchiq()
    {
        self::templateController("controller::postEchiq");
    }
    public static function postScience()
    {
        self::templateController("controller::postScience");
    }

    public static function postdownload()
    {
        self::templateController("controller::postdownload");
    }


}