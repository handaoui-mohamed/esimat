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
    const NB_TOPICS_IN_PAGE=6;

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

    private  static function getTopics($page,$type)
    {
        $premier_index=(int)($page-1)*self::NB_TOPICS_IN_PAGE;
        $type=(int)$type;
        $topicsReq=self::$connection->prepare('SELECT id,title,images,date_post from article where type='.$type.' ORDER BY id desc limit '. $premier_index.','.self::NB_TOPICS_IN_PAGE);
        $topicsReq->execute(array());
        $topics=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $topics;
    }
    public static function getScientifiqueTopics($page)
    {
        return self::getTopics($page,1);
    }
    /**
     * @param $page int
     */
    public static function getEchiquienneTopics($page)
    {
        return self::getTopics($page,0);
    }
}