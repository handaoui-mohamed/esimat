<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 18:37
 */
session_start();
require "../vendor/autoload.php";
use KikimR\router\Router;


$middleware= [["fn"=>"admin\\src\\controller\\ControllerAutontification::ditecteAutorisation", "params"=>[]]];

Router::init($middleware); //midelware de session et d'autorisation
/*******Conenxion *******/
Router::get("login","admin\\src\\controller\\Connexion::login" );
Router::post("login","admin\\src\\controller\\Connexion::postLogin");
Router::get("logout","admin\\src\\controller\\Connexion::logout");

/***********************************    Admin       ************/

Router::get("home","admin\\src\\controller\\BindRouter::Home");

/****Get form ****/
Router::get("topic","admin\\src\\controller\\BindRouter::formPostTopic","post");
Router::get("album","admin\\src\\controller\\BindRouter::formPostAlbum","post");
Router::get("file","admin\\src\\controller\\BindRouter::formPostFile","post");
/**/Router::get("admin","admin\\src\\controller\\BindRouter::formPostAdmin","post");

/**get*/
Router::get("message/[id]","admin\\src\\controller\\BindRouter::getMessage","")
    ->with("id",'[1-9][0-9]{0,9}');
/****post form ****/

Router::post("topic","admin\\src\\controller\\BindRouter::postTopic","post");
Router::post("album","admin\\src\\controller\\BindRouter::postAlbum","post");
Router::post("file","admin\\src\\controller\\BindRouter::postFile","post");
Router::post("admin","admin\\src\\controller\\BindRouter::postAdmin","post");

/******show list******/

Router::get("topics","admin\\src\\controller\\BindRouter::listTopics","list");
Router::get("albums","admin\\src\\controller\\BindRouter::listAlbums","list");
Router::get("files","admin\\src\\controller\\BindRouter::listFiles","list");
/**/Router::get("subs","admin\\src\\controller\\BindRouter::listSubs","list");
/**/Router::get("messages","admin\\src\\controller\\BindRouter::listMessages","list");

/******delete******/

Router::post("topic","admin\\src\\controller\\BindRouter::deleteTopic","delete");
Router::post("album","admin\\src\\controller\\BindRouter::deleteAlbum","delete");
Router::post("file","admin\\src\\controller\\BindRouter::deleteFile","delete");
Router::post("message","admin\\src\\controller\\BindRouter::deleteMessage","delete");
/**/Router::post("sub","admin\\src\\controller\\BindRouter::deleteSub","delete");
/**/Router::post("admin","admin\\src\\controller\\BindRouter::deleteAdmin","delete");

/******update******/
/**/Router::get("topic/[id]","admin\\src\\controller\\BindRouter::formUpdateTopic","update");
/**/Router::post("topic/[id]","admin\\src\\controller\\BindRouter::updateTopic","update");
/**/Router::get("album/[id]","admin\\src\\controller\\BindRouter::formUpdateAlbum","update");
/**/Router::post("album/[id]","admin\\src\\controller\\BindRouter::updateAlbum","update");
/**/Router::post("album/image/[id]","admin\\src\\controller\\BindRouter::deleteImage","delete");
/**/Router::get("file/[id]","admin\\src\\controller\\BindRouter::formUpdateFile","update");
/**/Router::post("file/[id]","admin\\src\\controller\\BindRouter::updateFile","update");




/**********root*************/
Router::get("admins","admin\\src\\controller\\BindRouter::showAdmins","root");
Router::when(404,'../errors/404.html');

Router::run();
