<?php

require'vendor/autoload.php';
use KikimR\router\Router;


$Middlewares=array(array('fn'=>'app\\view\\view::header',"params"=>["logo"]));

Router::init($Middlewares);// Middlewares ou fonctions toujours éxécutées

Router::get("/",function(){echo"HI site!!";});

Router::get("hello/[id]","app\\view\\view::header")
		->with('id','[0-9]+');

Router::when(404,"errors/404.html");

Router::run();



?>


