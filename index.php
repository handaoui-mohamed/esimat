<?php

require'vendor/autoload.php';
use KikimR\router\Router;


Router::init();// Middlewares ou fonctions toujours éxécutées

Router::get("/","app\\controller\Controller::index");

Router::get("echiquienne/articles/[page]","app\\controller\\Controller::echiquienne")
		->with("page",'[1-9][0-9]{0,9}')
		->addPath("echiquienne/articles");// la première page soit avec /1 ou directement /

Router::get("echiquienne/article/[id]","app\\controller\\Controller::topic")
    ->with("id",'[1-9][0-9]{0,9}');

Router::get("echiquienne/downloads/[page]","app\\controller\\Controller::echiquienneDownloads")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("echiquienne/downloads");// la première page soit avec /1 ou directement /

Router::get("scientifique/articles/[page]","app\\controller\\Controller::scientifique")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("scientifique/");// la première page soit avec /1 ou directement /

Router::get("albums/[page]","app\\controller\\Controller::albums")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("albums/");
Router::get("album/[id]","app\\controller\\Controller::album")
    ->with("id",'[1-9][0-9]{0,9}');



Router::when(404,"errors/404.html");

Router::run();

?>