<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 20:52
 */
namespace admin\src\model;
use app\Glob;
class Model
{
 public static $can_connect=false;
 public static $connection=null;

 public static function init()
 {
     if (empty(self::$connection))
     {
         try
         {
             self::$connection = new \PDO('mysql:host='.Glob::DB_HOST.';dbname='.Glob::DB_NAME,
                 Glob::DB_UM,
                 Glob::DB_PW
             );
             self::$can_connect=true;
         }
         catch (\PDOException $e)
         {
             self::$can_connect=false;
         }
     }
 }

}
