<?php

namespace app\view;

use app\Glob;

class View
{


    private static $staticFilesDir='static/';

    /*
     * pageType=
     * 0 => HOME
     *
     * 10 => echique pagine
     * 11 => echique topic
     * 12 => echique download pagine
     *
     * 20 => scientifique pagine
     * 21 => scientifique topic
     * 22 => scientifique  download pagine
     *
     * 30  => catalogues des images
     * 31 => dans un catalogue
     * .
     * .
     * .
     * .
    */


    /**
     * @param string $title
     * @param int $pageType
     * @param string $url url de la page (elle est génerée par le controleur)
     * @param $url_img /lien de l'image dans les réseaux soc
     * @param $state 404/500/200
     * @return string
     */

    private static function genSEO ($title, $pageType, $url, $url_img, $state)
    {
        //Générer le SEO (s) d'une page
        //$url=urlencode($url); si l url => par user
        $url_img=Glob::DOMAIN.self::$staticFilesDir.$url_img;
        return'<!--SeO part 1--> 
              <meta property="og:type" content=""/>
              <meta property="og:title" content="Le club '.$title.'">
              <meta property="og:url" content="'.$url.'">
              <meta property="og:image" content="'.$url_img.'">
              <meta property="og:description" content="Description sur cette page"/>
              <meta property="og:site_name" content="ESIMAT">
              <meta property="fb:pages" content=""> 
              <!--twitter-->   
              <meta name="twitter:card" content="summary">
              <meta name="twitter:creator" content="nom de site">
              <meta name="twitter:description" content="Description sur cette page ">
              <meta name="twitter:domain" content="esimat.com">
              <meta name="twitter:image" content="'.$url_img.'">
              <meta name="twitter:site" content="ESIMAT">
              <meta name="twitter:title" content="">
              <!--meta-->
              <meta name="description" content="Description sur cette page">
              <title>'.$title.'</title>
             <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
             <meta name="author" content="@EsiMat">';
    }



    public static function startPage($pageType,$title,$url,$url_img, $arrayCSS=[],$state=200)
    {
        $StaticFilesDirLink=Glob::DOMAIN.self::$staticFilesDir;

        $nb=count($arrayCSS);

        $css='';

        for ($i=0;$i<$nb;$i++)
            $css.='<link href="'.$StaticFilesDirLink.'css/'.$arrayCSS[$i].'" rel="stylesheet" type="text/css" media="all" />';


        echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
'.self::genSEO($title,$pageType,$url,$url_img,$state).'
<link href="'.$StaticFilesDirLink.'css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="'.$StaticFilesDirLink.'css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="'.$StaticFilesDirLink.'css/font-awesome.min.css" />
<link href="//fonts.googleapis.com/css?family=Varela+Round&subset=hebrew" rel="stylesheet">
<link href=\'//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic\' rel=\'stylesheet\' type=\'text/css\'>
'.$css.'
</head>
<body>';
    }

    public static function endPage($Arrayscript=[])
    {
        $StaticFilesDirLink=Glob::DOMAIN.self::$staticFilesDir;
        $nb=count($Arrayscript);
        $scripts='';


        for ($i=0;$i<$nb;$i++)
            $scripts.='<script src="'. $StaticFilesDirLink.'js/'.$Arrayscript[$i].'"></script>';


        echo'
<script src="'.$StaticFilesDirLink.'js/jquery-2.1.4.min.js"></script>
<script src="'.$StaticFilesDirLink.'js/main.js"></script>
<script src="'.$StaticFilesDirLink.'js/bootstrap.js"></script>
<script src="'.$StaticFilesDirLink.'js/move-top.js"></script>
<script src="'.$StaticFilesDirLink.'js/easing.js"></script>
<script src="'.$StaticFilesDirLink.'js/end.js"></script>

'.$scripts.'
</body></html>';
    }

    private static function setActive($pageType,$hisType)
    {
        $pageState = $pageType==$hisType?'class="active"':'';
        return $pageState;
    }

    /**
     * @param $pageType
     * @return string
     * génère le menu dynamiquement
     */
    private static function getNavBar($pageType)
    {

      return '<nav class="cl-effect-13" id="cl-effect-13">
						<ul class="nav navbar-nav">
							<li '.self::setActive($pageType,0).'><a href="'.Glob::DOMAIN.'">Home</a></li>
							<li '.self::setActive($pageType,10).'><a href="'.Glob::DOMAIN.'echiquienne">Échiquienne</a></li>
							<li '.self::setActive($pageType,20).'><a href="'.Glob::DOMAIN.'scientifique">Scientifique</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Short Codes <b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="icons.html">Icons</a></li>
									<li><a href="typography.html">Typography</a></li>
								</ul>
							</li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
						<div class="w3_agile_login">
							<div class="cd-main-header">
								<a class="cd-search-trigger" href="#cd-search"> <span></span></a>
								<!-- cd-header-buttons -->
							</div>
							<div id="cd-search" class="cd-search">
								<form action="#" method="post">
									<input name="Search" type="search" placeholder="Search...">
								</form>
							</div>
						</div>
					</nav>';
    }


    public static function header($pageType=0)
    {
        $slider="";
        $prefClass='1';

        if ($pageType==0)
        {
            $slider='<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li>
								<div class="agileits_w3layouts_banner_info">
									<h3>simply dummy text of the printing</h3>
									<p>Standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
									<div class="agileits_w3layouts_banner_info_pos">
										<ul>
											<li><a href="#">Facebook</a><label></label></li>
											<li><a href="#">Twitter</a><label></label></li>
											<li><a href="#">Instagram</a><label></label></li>
											<li><a href="#">VK</a><label></label></li>
										</ul>
									</div>
								</div>
							</li>
							<li>
								<div class="agileits_w3layouts_banner_info">
									<h3>simply dummy text of the printing</h3>
									<p>Standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
									<div class="agileits_w3layouts_banner_info_pos">
										<ul>
											<li><a href="#">Instagram</a><label></label></li>
											<li><a href="#">VK</a><label></label></li>
											<li><a href="#">Facebook</a><label></label></li>
											<li><a href="#">Twitter</a><label></label></li>
										</ul>
									</div>
								</div>
							</li>
							<li>
								<div class="agileits_w3layouts_banner_info">
									<h3>simply dummy text of the printing</h3>
									<p>Standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
									<div class="agileits_w3layouts_banner_info_pos">
										<ul>
											<li><a href="#">Twitter</a><label></label></li>
											<li><a href="#">Instagram</a><label></label></li>
											<li><a href="#">Facebook</a><label></label></li>
											<li><a href="#">VK</a><label></label></li>
											<div class="clearfix"> </div>
										</ul>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</section>
			<!-- //flexSlider -->';
            $prefClass='';
        }
           echo '<div class="banner'.$prefClass.'">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="'.Glob::DOMAIN.'"><span>ESI </span>MAT</a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					'.self::getNavBar($pageType).'
				</div>
			</nav>
			'.$slider.'
		</div>
	</div>
<!-- //banner -->';
    }

}

?>