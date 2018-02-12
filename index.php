<?php
session_start();
require'vendor/autoload.php';
use KikimR\router\Router;



Router::init();// Middlewares ou fonctions toujours éxécutées

Router::get("/","app\\controller\\Controller::index");

Router::get("echiquienne/articles/[page]","app\\controller\\Controller::echiquienneTopics")
		->with("page",'[1-9][0-9]{0,9}')
		->addPath("echiquienne/articles");// la première page soit avec /1 ou directement /

Router::get("echiquienne/article/[id]","app\\controller\\Controller::echiquienneTopic")
    ->with("id",'[1-9][0-9]{0,9}');

Router::get("echiquienne/downloads/[page]","app\\controller\\Controller::echiquienneDownloads")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("echiquienne/downloads");

Router::get("scientifique/articles/[page]","app\\controller\\Controller::scientifiqueTopics")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("scientifique/articles");

Router::get("scientifique/article/[id]","app\\controller\\Controller::scientifiqueTopic")
    ->with("id",'[1-9][0-9]{0,9}');

Router::get("scientifique/downloads/[page]","app\\controller\\Controller::scientifiqueDownloads")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("scientifique/downloads");

Router::get("albums/[page]","app\\controller\\Controller::albums")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("albums/");
Router::get("album/[id]","app\\controller\\Controller::album")
    ->with("id",'[1-9][0-9]{0,9}');

Router::post("contact","app\\controller\\Controller::contact");
Router::post("subscription","app\\controller\\Controller::subscription");




Router::when(404,"errors/404.html");

Router::run();

?>