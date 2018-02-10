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
Router::get("login","admin\\src\\controller\\connexion::login" );
Router::post("login","admin\\src\\controller\\connexion::postLogin");
Router::get("logout","admin\\src\\controller\\connexion::logout");

/***********************************    Admin       ************/

Router::get("home","admin\\src\\controller\\bindRouter::Home");

/****Get form ****/
Router::get("topic","admin\\src\\controller\\bindRouter::formPostTopic","post");
Router::get("album","admin\\src\\controller\\bindRouter::formPostAlbum","post");
Router::get("file","admin\\src\\controller\\bindRouter::formPostFile","post");
/**/Router::get("admin","admin\\src\\controller\\bindRouter::formPostAdmin","post");

/**get*/
/**/Router::get("message/[id]","admin\\src\\controller\\bindRouter::getMessage","");
/****post form ****/

Router::post("topic","admin\\src\\controller\\bindRouter::postTopic","post");
Router::post("album","admin\\src\\controller\\bindRouter::postAlbum","post");
Router::post("file","admin\\src\\controller\\bindRouter::postFile","post");
/**/Router::post("admin","admin\\src\\controller\\bindRouter::postAdmin","post");

/******show list******/

Router::get("topics","admin\\src\\controller\\bindRouter::listTopics","list");
Router::get("albums","admin\\src\\controller\\bindRouter::listAlbums","list");
Router::get("files","admin\\src\\controller\\bindRouter::listFiles","list");
/**/Router::get("subs","admin\\src\\controller\\bindRouter::listSubs","list");
/**/Router::get("messages","admin\\src\\controller\\bindRouter::listMessages","list");

/******delete******/

Router::post("topic","admin\\src\\controller\\bindRouter::deleteTopic","delete");
Router::post("album","admin\\src\\controller\\bindRouter::deleteAlbum","delete");
Router::post("file","admin\\src\\controller\\bindRouter::deleteFile","delete");
Router::post("message","admin\\src\\controller\\bindRouter::deleteMessage","delete");
/**/Router::post("sub","admin\\src\\controller\\bindRouter::deleteSub","delete");
/**/Router::post("admin","admin\\src\\controller\\bindRouter::deleteAdmin","delete");

/******update******/
/**/Router::get("topic/[id]","admin\\src\\controller\\bindRouter::formUpdateTopic","update");
/**/Router::post("topic/[id]","admin\\src\\controller\\bindRouter::updateTopic","update");
/**/Router::get("album/[id]","admin\\src\\controller\\bindRouter::formUpdateAlbum","update");
/**/Router::post("album/[id]","admin\\src\\controller\\bindRouter::updateAlbum","update");
/**/Router::post("album/image/[id]","admin\\src\\controller\\bindRouter::deleteImage","delete");
/**/Router::get("file/[id]","admin\\src\\controller\\bindRouter::formUpdateFile","update");
/**/Router::post("file/[id]","admin\\src\\controller\\bindRouter::updateFile","update");




/**********root*************/
Router::get("admins","admin\\src\\controller\\bindRouter::showAdmins","root");
Router::when(404,'../errors/404.html');

Router::run();
