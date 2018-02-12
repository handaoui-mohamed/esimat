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
    public static function getAdmins()
    {
        $req = self::$connection->prepare('select * from users WHERE role!="root" ');
        $req->execute(array());
        $admins = $req->fetchAll(\PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $admins;

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
        $result = $reqGetAdmin->fetchAll(\PDO::FETCH_ASSOC);
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



    /**********************create***************/

    public static function addTopic($topic)
    {
        $reqGetAdmin = self::$connection->prepare('INSERT INTO 
        article (title,body,type,date_post,images,imagesmin,videos)VALUES 
        (:title,:body,:type,NOW(),:images,:imagesmin,:videos)
        ');
        $reqGetAdmin->execute(array(
            'title'=>$topic['title'],
            'body'=>$topic['body'],
            'type'=>$topic['type'],
            'images'=>$topic['img'],
            'imagesmin'=>$topic['imgmin'],
            'videos'=>$topic['videos']
        ));

        $reqGetAdmin->closeCursor();
        return self::$connection->lastInsertId();

    }

    public static function creatAlbum($album)
    {
        $reqGetAdmin = self::$connection->prepare('INSERT INTO 
        album (title,description,date_post)VALUES (:title,:description,NOW())');
        $reqGetAdmin->execute(array(
            'title'=>$album['title'],
            'description'=>$album['description']
        ));
        $idAlbum=self::$connection->lastInsertId();
        $nb = count ($album['img']);
        if ($nb>0)
        {    $requete=array();
            $execArray=array();
            for ($i=0;$i<$nb;$i++)
            {
                $requete[]=' (:image'.$i.',:imagemin'.$i.',:title'.$i.','.$idAlbum.')';
                $execArray['image'.$i]=$album['img'][$i];
                $execArray['imagemin'.$i]=$album['imgmin'][$i];
                $execArray['title'.$i]=$album['titles'][$i];
                ;
            }
            $requete=implode(',',$requete);
            $reqGetAdmin = self::$connection->prepare('INSERT INTO album_image  (image,imagemin,title,album_id) VALUES '.$requete);
            $reqGetAdmin->execute($execArray);
        }

        return $idAlbum;

    }

    public static function creatFile($file)
    {
        $reqGetAdmin = self::$connection->prepare('INSERT INTO download (title,type,source,image,date_post) VALUES(:title,:type,:src,:img,NOW())');
        $reqGetAdmin->execute(array(
            'type'=>$file['type'],
            'title'=>$file['title'],
            'src'=>$file['file'],
            'img'=>$file['img']
        ));
        return self::$connection->lastInsertId();
    }

    /**********************getall***************/

    public static function getAdminTopics($typeReqCondotion="true")
    {
        $reqGetAdmin = self::$connection->prepare('SELECT * FROM article WHERE '.$typeReqCondotion.' ORDER by id desc');
        $reqGetAdmin->execute(array());
        $result = $reqGetAdmin->fetchAll(\PDO::FETCH_ASSOC);
        $reqGetAdmin->closeCursor();
        return $result;
    }

    public static function getAdminEchiquienneTopics()
    {
        return self::getAdminTopics('type=1');
    }
    public static function getAdminScientifiqueTopics()
    {
        return self::getAdminTopics('type=0');
    }

    public static function getAdminFiles()
    {
        $reqGetAdmin = self::$connection->prepare('SELECT * FROM download ORDER BY id DESC ');
        $reqGetAdmin->execute(array());
        $result = $reqGetAdmin->fetchAll(\PDO::FETCH_ASSOC);
        $reqGetAdmin->closeCursor();
        return $result;
    }
    public static function getMessages()
    {
        $reqGetAdmin = self::$connection->prepare('SELECT * FROM message ORDER BY id DESC ');
        $reqGetAdmin->execute(array());
        $result = $reqGetAdmin->fetchAll(\PDO::FETCH_ASSOC);
        $reqGetAdmin->closeCursor();
        return $result;
    }
    public static function getMessage($id)
    {
        $req = self::$connection->prepare('SELECT * FROM message WHERE id=:id');
        $req->execute(array('id'=>$id));
        $result = $req->fetch();
        if (!empty($result['id'])&&$result['view']!=1)
        {
            self::setMessageView($id);
        }
        return $result;
    }
    public static function getAdminAlbums()
    {
        $req = self::$connection->prepare('select * from album WHERE');
        $req->execute(array());
        $admins = $req->fetchAll(\PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $admins;
    }


    /**delete**/

    private  static function delete ($table,$id)
    {
        $req = self::$connection->prepare('delete from '.$table.' WHERE id=:id');
        $req->execute(array('id' => $id));
        $req->closeCursor();
    }

    public static function deleteMessage($id)
    {
        self::delete('message',$id);
    }

    public static function deleteTopic($id)
    {
        self::delete('article',$id);
    }

    public static function deleteFile($id)
    {
        self::delete('download',$id);
    }
    public static function deleteAlbum($id)
    {
        $req = self::$connection->prepare('delete from album_image WHERE album_id=:id');
        $req->execute(array('id' => $id));
        $req->closeCursor();
        self::delete('album',$id);
    }

    public static function addAdmin($email,$pw,$name,$role)
    {
        $reqGetAdmin = self::$connection->prepare('INSERT INTO users (email, password, role, name) VALUES(:email, :pw, :role,:name)');
        $reqGetAdmin->execute(array(
            'email'=>$email,
            'pw'=>$pw,
            'name'=>$name,
            'role'=>$role
        ));
        $reqGetAdmin->closeCursor();
    }

    public static function existAdmin($email)
    {
        $reqGetAdmin = self::$connection->prepare('select id from users WHERE email=:email');
        $reqGetAdmin->execute(array('email'=>$email));
        $email=$reqGetAdmin->fetch();
        $reqGetAdmin->closeCursor();
        return !empty($email['id']);
    }

}