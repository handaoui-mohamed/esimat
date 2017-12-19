<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 22:02
 */

namespace admin\src\controller;

use app\Glob;
use admin\src\view;
use admin\src\model;
//use captchagoogle

class Connexion
{
 private static function generKeyFormConnexion ()
 {
     $_SESSION['user_agent']=!empty($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:0;
     $_SESSION['key_form_connexion']=rand(800000,9008000).sha1('à(dm'.rand(900,800000).'_è'.time()).rand(800000,9008000);

    return $_SESSION['key_form_connexion'];
 }

 public static function login()
 {

   if (ControllerAutontification::isConnect())
   {
       header("location:".Glob::DOMAIN."home");
       exit;
   }
   else
   {
       view\Connexion::showConnexion(self::generKeyFormConnexion());
   }
 }

 public static function vrefConnexion()
 {

 }

}