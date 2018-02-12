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
    const NB_ALBUMS_IN_PAGE=6;
    const NB_DOWNLOAD_IN_PAGE=3;

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
        $topicsReq=self::$connection->prepare('SELECT * from article where type='.$type.' ORDER BY id desc limit '. $premier_index.','.self::NB_TOPICS_IN_PAGE);
        $topicsReq->execute(array());
        $topics=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $topics;
    }
    public static function getLastTopics ($nb,$type)
    {
        $type=(int)$type;
        $topicsReq=self::$connection->prepare('SELECT * from article where type='.$type.' ORDER BY id desc limit 0,'.(int)$nb);
        $topicsReq->execute(array());
        $topics=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $topics;
    }
    public static function getScientifiqueTopics($page)
    {
        return self::getTopics($page,0);
    }
    /**
     * @param $page int
     */
    public static function getEchiquienneTopics($page)
    {
        return self::getTopics($page,1);
    }

    private static function getNbPages($type)
    {
        $Req=self::$connection->prepare('SELECT count(*) as nb from article where type='.$type);
        $Req->execute(array());
        $data=$Req->fetch();
        $Req->closeCursor();
        $data =(int)$data['nb'];
        $nb=(int)($data/self::NB_TOPICS_IN_PAGE);
        if ($data%self::NB_TOPICS_IN_PAGE>0) {
            $nb++;
        }
        return $nb;
    }

    public static function getNbPagesEchiquienne()
    {
        return self::getNbPages(1);
    }

    public static function getNbPagesScientifique()
    {
        return self::getNbPages(0);
    }

    public static function incVisite()
    {
        $Req=self::$connection->prepare('UPDATE visite set visite.nb_visite=visite.nb_visite+1 WHERE id=1');
        $Req->execute(array());
        $Req->closeCursor();
    }

    public static function getTopic($id)
    {
        $Req=self::$connection->prepare('SELECT * from article where id=:id');
        $Req->execute(array('id'=>$id));
        $topic= $Req->fetch();
        $Req->closeCursor();
        return $topic;
    }

    public  static function getAlbumImages($id)
    {

        $topicsReq=self::$connection->prepare('SELECT * from album_image WHERE album_id=:id');
        $topicsReq->execute(array('id'=>$id));
        $images=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $images;
    }
    public  static function getAlbums($page)
    {

        $premier_index=(int)($page-1)*self::NB_ALBUMS_IN_PAGE;
        $topicsReq=self::$connection->prepare('SELECT * from album  ORDER BY id desc limit '. $premier_index.','.self::NB_ALBUMS_IN_PAGE);
        $topicsReq->execute(array());
        $topics=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $topics;
    }

    public  static function getNbPagesAlbums()
    {
        $topicsReq=self::$connection->prepare('SELECT count(*) as nb from album');
        $topicsReq->execute(array());
        $topics=$topicsReq->fetch();
        $topicsReq->closeCursor();
        $nb=(int)((int)$topics['nb']/self::NB_ALBUMS_IN_PAGE);
        if ($topics['nb']%self::NB_ALBUMS_IN_PAGE>0) {
            $nb++;
        }
        return $nb;
    }



    public static function getAlbum($id)
    {
        $topicsReq=self::$connection->prepare('SELECT * from album WHERE id=:id');
        $topicsReq->execute(array('id'=>$id));
        $album=$topicsReq->fetch();
        return $album;

    }

    public  static function getNbPagesDownload($type)
    {
        $topicsReq=self::$connection->prepare('SELECT count(*) as nb from download WHERE type=:atype');
        $topicsReq->execute(array('atype'=>$type));
        $topics=$topicsReq->fetch();
        $topicsReq->closeCursor();
        $nb=(int)((int)$topics['nb']/self::NB_DOWNLOAD_IN_PAGE);
        if ($topics['nb']%self::NB_DOWNLOAD_IN_PAGE>0) {
            $nb++;
        }
        return $nb;
    }
    public  static function getDownloads($page,$type)
    {

        $premier_index=(int)($page-1)*self::NB_DOWNLOAD_IN_PAGE;
        $topicsReq=self::$connection->prepare('SELECT * from download  WHERE type =:t ORDER BY id desc limit '. $premier_index.','.self::NB_DOWNLOAD_IN_PAGE);
        $topicsReq->execute(array('t'=>$type));
        $topics=$topicsReq->fetchAll(\PDO::FETCH_ASSOC);
        $topicsReq->closeCursor();
        return $topics;
    }
    public static  function  addNewMessage($email,$name,$message)
    {

        $topicsReq=self::$connection->prepare('Insert Into message (email, name, body, view)VALUES (:email, :aname, :body, :v) ');
        $topicsReq->execute(array("email"=>$email,"aname"=>$name,"body"=>$message,"v"=>"0"));
        $topicsReq->closeCursor();

    }

    public static function getSubByEmail($email)
    {
        $topicsReq=self::$connection->prepare('SELECT * from subscription  WHERE email=:email');
        $topicsReq->execute(array('email'=>$email));
        $data=$topicsReq->fetch();
        $topicsReq->closeCursor();
        return $data;
    }

    public static function addSub($email)
    {
        $topicsReq=self::$connection->prepare('INSERT INTO subscription (email)VALUES (:email)');
        $topicsReq->execute(array('email'=>$email));
        $topicsReq->closeCursor();
    }
}