<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 21/12/2017
 * Time: 15:33
 */

namespace app\model;
use app\Glob;


class Model
{
    public static $can_connect=false;
    public static $connection=null;

    public static function Init()
    {
        if (empty(self::$connection))
        {
            try
            {
                self::$connection = new \PDO('mysql:host='.Glob::DB_HOST.';dbname='.Glob::DB_NAME,
                                             Glob::DB_UM,
                                            Glob::DB_PW);
                self::$can_connect=true;
            }
            catch (\PDOException $e)
            {
                self::$can_connect=false;
            }
        }
    }

    /**
     * @param $nb int
     * @param $page int
     * return $nb scientifique topics de la page $page
     */
    public static function getScientifiqueTopics($nb, $page)
    {

    }
    /**
     * @param $nb int
     * @param $page int
     * return $nb scientifique topics de la page $page
     */
    public static function getEchiquienneTopics($nb,$page)
    {

    }
}
