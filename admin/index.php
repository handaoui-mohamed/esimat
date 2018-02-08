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

/*******Admin*******/
Router::get("home","admin\\src\\controller\\bindRouter::Home");

Router::get("topic","admin\\src\\controller\\bindRouter::formPostTopic","post");
Router::post("topics","admin\\src\\controller\\bindRouter::postTopic","list");






Router::when(404,'../errors/404.html');

Router::run();
