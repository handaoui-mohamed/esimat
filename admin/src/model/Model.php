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
        $reqGetAdmin=self::$connection->prepare('SELECT * FROM users where email=:email AND password=:pw limit 0,1');
        $reqGetAdmin->execute(array('email'=>$email,'pw'=>$pw));
        return $reqGetAdmin->fetch();

    }
}
