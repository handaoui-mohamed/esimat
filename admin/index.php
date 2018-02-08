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

/****post form ****/

Router::post("topic","admin\\src\\controller\\bindRouter::postTopic","post");
Router::post("album","admin\\src\\controller\\bindRouter::postAlbum","post");
Router::post("file","admin\\src\\controller\\bindRouter::postFile","post");

/******show list******/

Router::get("topics","admin\\src\\controller\\bindRouter::listTopics","list");
Router::get("albums","admin\\src\\controller\\bindRouter::listAlbums","list");
Router::get("files","admin\\src\\controller\\bindRouter::listFiles","list");

/******delete list******/

/******update list******/




Router::when(404,'../errors/404.html');

Router::run();
