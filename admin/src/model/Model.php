<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 20:52
 */

namespace admin\src\model;

use app\model\Model as ModelUser;

class Model extends ModelUser
{


    public static function getAdmin($email, $pw)
    {
        $reqGetAdmin = self::$connection->prepare('SELECT * FROM users where email=:email AND password=:pw limit 0,1');
        $reqGetAdmin->execute(array('email' => $email, 'pw' => $pw));
        $user = $reqGetAdmin->fetch();
        $reqGetAdmin->closeCursor();
        return $user;

    }

    public static function getNotViewMessages()
    {
        $reqGetmessages = self::$connection->prepare('SELECT * FROM message where view=0');
        $reqGetmessages->execute(array());
        $messages = $reqGetmessages->fetchAll(\PDO::FETCH_ASSOC);
        $reqGetmessages->closeCursor();
        return $messages;

    }


    public static function setMessageView($id)
    {
        $reqmessages = self::$connection->prepare('UPDATE message set message.view=1 WHERE id=:id');
        $reqmessages->execute(array('id' => $id));
        $reqmessages->closeCursor();
    }

    public static function getMessages()
    {

    }

    public static function deleteMessage($id)
    {

    }


    /************************* STATES ***********************/
    public static function getNbVisite()
    {
        $reqGetAdmin = self::$connection->prepare('SELECT nb_visite FROM visite WHERE id=1');
        $reqGetAdmin->execute(array());
        $result = $reqGetAdmin->fetch();
        $reqGetAdmin->closeCursor();
        return $result['nb_visite'];

    }

    public static function getNbArticlesByType()
    {
        $reqGetAdmin = self::$connection->prepare('SELECT COUNT(*) as nb,type FROM article GROUP BY type');
        $reqGetAdmin->execute(array());
        $result = $reqGetAdmin->fetch();
        $reqGetAdmin->closeCursor();
        return $result;
    }

    private static function getNb($tableName)
    {
        $reqGetmessages = self::$connection->prepare('SELECT count(*) as nb FROM ' . $tableName);
        $reqGetmessages->execute(array());
        $result = $reqGetmessages->fetch();
        $reqGetmessages->closeCursor();
        return $result['nb'];
    }

    public static function getNbAlbum()
    {
        return self::getNb('album');

    }

    public static function getNbAbonnes()
    {
        return self::getNb('subscription');
    }

    public static function getNbMessages()
    {
        return self::getNb('message');
    }
    public static function getNbDownloads()
    {
        return self::getNb('download');
    }

    public static function getHomeState()
    {
        return array("article"=>self::getNbArticlesByType(),
                      "album"=>self::getNbAlbum(),
                      "sub"=>self::getNbAbonnes(),
                       "message"=>self::getNbMessages(),
                        "visite"=>self::getNbVisite(),
                        "download"=>self::getNbDownloads()
            );
    }


}