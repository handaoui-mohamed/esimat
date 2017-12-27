<?php

require'vendor/autoload.php';
use KikimR\router\Router;


Router::init();// Middlewares ou fonctions toujours éxécutées

Router::get("/","app\\controller\controller::index");

Router::get("echiquienne/[page]","app\\controller\controller::echiquienne")
		->with("page",'[1-9][0-9]{0,9}')
		->addPath("echiquienne/");// la première page soit avec /1 ou directement /

Router::get("scientifique/[page]","app\\controller\controller::scientifique")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("scientifique/");// la première page soit avec /1 ou directement /

Router::get("albums/[page]","app\\controller\controller::albums")
    ->with("page",'[1-9][0-9]{0,9}')
    ->addPath("albums/");
Router::get("album/[id]","app\\controller\controller::album")
    ->with("id",'[1-9][0-9]{0,9}');



Router::when(404,"errors/404.html");

Router::run();

?>