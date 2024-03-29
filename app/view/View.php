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
     * 30  => album des images
     * 31 => dans un album
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
              <meta property="og:title" content="'.$title.'">
              <meta property="og:url" content="'.$url.'">
              <meta property="og:image" content="'.$url_img.'">
              <meta property="og:description" content="Le club esimat"/>
              <meta property="og:site_name" content="ESIMAT">
              <meta property="fb:pages" content=""> 
              <!--twitter-->   
              <meta name="twitter:card" content="summary">
              <meta name="twitter:creator" content="esi-mat.com">
              <meta name="twitter:description" content="esimat club">
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
<link rel="icon"  href="'.Glob::DOMAIN.'favicon/logo.ico">
'.self::genSEO($title,$pageType,$url,$url_img,$state).'
<link href="'.$StaticFilesDirLink.'css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="'.$StaticFilesDirLink.'css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="'.$StaticFilesDirLink.'css/font-awesome.min.css" />
<link href="//fonts.googleapis.com/css?family=Varela+Round&subset=hebrew" rel="stylesheet">
<link href=\'//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic\' rel=\'stylesheet\' type=\'text/css\'>
'.$css.'
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11\';
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';
    }

    private static function setActive($pageType,$hisType)
    {
        $pageState = $pageType==$hisType?'active':'';
        return $pageState;
    }

    /**
     * @param $pageType
     * @return string
     * génère le menu dynamiquement
     */
    private static function getNavBar($pageType)
    {
        $scroll="";
        if ($pageType==0) $scroll='class="scroll"';
      return '<nav class="cl-effect-13" id="cl-effect-13">
						<ul class="nav navbar-nav">
							<li class="'.self::setActive($pageType,0).'"><a href="'.Glob::DOMAIN.'">Home</a></li>
							<li class="'.self::setActive($pageType,31).self::setActive($pageType,30).'"><a href="'.Glob::DOMAIN.'albums">Albums</a></li>
							<li class="dropdown '.self::setActive($pageType,10).self::setActive($pageType,11).self::setActive($pageType,12).'">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Échiquienne<b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="'.Glob::DOMAIN.'echiquienne/articles">Articles et Événements</a></li>
									<li><a href="'.Glob::DOMAIN.'echiquienne/downloads">Téléchargement</a></li>
								</ul>
							</li>
							<li class="dropdown '.self::setActive($pageType,20).self::setActive($pageType,21).self::setActive($pageType,22).'">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Scientifique<b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="'.Glob::DOMAIN.'scientifique/articles">Articles et Événements</a></li>
									<li><a href="'.Glob::DOMAIN.'scientifique/downloads">Téléchargements</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">ESIMAT<b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="'.Glob::DOMAIN.'#contact" '.$scroll.'>Contact</a></li>
									<li><a href="'.Glob::DOMAIN.'#apropos" '.$scroll.'>À propos</a></li>
									<li><a href="#MSociaux" class="scroll">Médias Sociaux</a></li>
								</ul>
							</li>
						</ul>
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
								<div class="agileits_w3layouts_banner_info" style="margin-top: 5px;">
								<h3>Esimat - Le site est en maintenance</h3>
									<p style="text-align: center;" >
									<img src="static/images/logoP.png"  style="border-radius: 100% 100%;max-width: 100%;display: inline-block;margin: auto;">
									</p>
									<p style="font-size: 2em;">Club des echecs</p>
								</div>
							</li>
							<li>
								<div class="agileits_w3layouts_banner_info" style="margin-top: 20px;">
				                <h3 style="text-transform: uppercase">troisième édition de la conference débat sur le chess computing</h3><br>
								</div>
								<p style="text-align: center;">
								<img src="static/images/conf3.png" class="ka" style="max-width: 100%;display: inline-block;margin: auto;max-height: 300px;">
								</p>
							</li>
							<li>
								<div class="agileits_w3layouts_banner_info" style="margin-top: 20px;">
				                <h3 style="text-transform: capitalize">deuxième conference sur le chess computing 2016</h3><br>
								</div>
									<p style="text-align: center;">
									<img src="static/images/conf2.jpg" class="ka" style="max-width: 100%;display: inline-block;margin: auto;max-height: 300px;">
									</p>
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
					
					<h1>
					<a class="navbar-brand" href="'.Glob::DOMAIN.'"><img src="'.Glob::DOMAIN.self::$staticFilesDir.'images/logo_.png" style="display: inline-block;width: 90px;height: 90px;border-radius: 100% 100%;margin-top: -12px;"> <span> ESI </span>MAT</a></h1>
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

    public static function endPage($Arrayscript=[])
    {
        $StaticFilesDirLink=Glob::DOMAIN.self::$staticFilesDir;
        $nb=count($Arrayscript);
        $scripts='';


        for ($i=0;$i<$nb;$i++)
            $scripts.='<script src="'. $StaticFilesDirLink.'js/'.$Arrayscript[$i].'"></script>';


        echo'<div class="copyright" style="padding-top: 0;margin-top: 60px;" >
		<div class="container" style="padding-top: 15px;">
			<div class="agileinfo"
				<div class="footer-heading">
				    <div class="col-lg-4" style="margin-top: 20px;"><br>
                        <img src="'.Glob::DOMAIN.self::$staticFilesDir.'images/logo.png" style="display: inline-block;width: 50%;height: 50%;border-radius: 100% 100%;">
                        <div style="color: white;margin-top: 10px;">
                           <br>© '.date("Y").' <b>ESIMAT</b>  Club <b>d\'Echecs</b> .</p> 
                        </div>
                    </div>
                   
					<div class="col-lg-4"  id="MSociaux">
                            <p class="agileits_dummy_para"> <b>Suivez nous sur les réseaux sociaux</b> ! <br></p><br><br>
                            <a href="javascript:open(\'https://www.facebook.com/club.esimat/\');" class="twitter facebook" style="font-size: 2em;"> <i class="fa fa-facebook"></i> </a><br>
                            <a href="#" class="twitter" style="font-size: 2em;margin-right: 40px;"><i class="fa fa-twitter"></i> </a>
                            <a href="#" class="twitter chrome" style="font-size: 2em;"> <i class="fa fa-google-plus"></i></a>
			    	</div>
			    	 <div class="col-lg-4">
			    	 <p>Notre page facebook</p><br><br>
                        <div class="fb-page" style="box-shadow: 1px 1px 12px #eee;" data-href="https://www.facebook.com/club.esimat/" data-tabs="timeline" data-height="100" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/club.esimat/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/club.esimat/">ESIMAT-Club d&#039;échecs</a></blockquote></div>
                    </div>
                    <br>
               
	
				</div>

			</div>
					<div style="text-align: center;font-weight: bold;color: white;margin-top: 10px;">
                    Tous les droits sont réservés</div>
		</div>

	</div>
<script src="'.$StaticFilesDirLink.'js/jquery-2.1.4.min.js"></script>
<script src="'.$StaticFilesDirLink.'js/main.js"></script>
<script src="'.$StaticFilesDirLink.'js/bootstrap.js"></script>
<script src="'.$StaticFilesDirLink.'js/move-top.js"></script>
<script src="'.$StaticFilesDirLink.'js/easing.js"></script>
<script src="'.$StaticFilesDirLink.'js/end.js"></script>
'.$scripts.'
</body></html>';
    }

    public static function pagine($pagetype,$start,$curpage,$end)
    {
        $links=array(
            "10"=>"echiquienne/articles/",
            "12"=>"echiquienne/downloads/",
            "30"=>"albums/",
            "20"=>"scientifique/articles/",
            "22"=>"scientifique/downloads/"
        );

        if (empty($links[$pagetype])) die("<b>Erreur controleur 1<br>");
        if ($curpage>$end){die("<b>Erreur controleur 2<br>");}
        if ($start>$curpage){die("<b>Erreur controleur 3<br>");}

        if ($curpage>1)
            $s='<li><a href="'.Glob::DOMAIN.$links[$pagetype].($curpage-1).'"><i class="fa fa-angle-left"></i></a></li>';
        else
            $s='<li class="disabled"><a ><i class="fa fa-angle-left"></i></a></li>';

        for ($i=$start;$i<$curpage;$i++)
            $s .= '<li><a href="'.Glob::DOMAIN.$links[$pagetype].$i.'">' . $i . '</a></li>';

        $s.='<li class="active"><a href="'.Glob::DOMAIN.$links[$pagetype].$i.'">'.$curpage.'</a></li>';

        for ($i=$curpage+1;$i<=$end;$i++)
            $s .= '<li><a href="'.Glob::DOMAIN.$links[$pagetype].$i.'">' . $i . '</a></li>';

        if ($end>$curpage)
            $s.='<li><a href="'.Glob::DOMAIN.$links[$pagetype].($curpage+1).'"><i class="fa fa-angle-right"></i></a></li>';
        else
            $s.='<li class="disabled"><a><i class="fa fa-angle-right"></i></a></li>';

return '<div style="text-align: center;margin-top: 10px;"><br><br><ul class="pagination pagination-lg">'.$s.'</ul></div>';
        }


    /**
     * @param $link array
     * @return string
     */
    public static function getlink($link)
  {
      $nb=count($link);
      $s='<ol class="breadcrumb">
            	    <li><a href="'.Glob::DOMAIN.'">@ESIMAT</a></li>';

      for ($i=0;$i<$nb-1;$i++)
      {
        $s.='<li><a href="'.Glob::DOMAIN.$link[$i]['link'].'">'.ucfirst($link[$i]['name']).'</a></li>';
      }

      $s.= '<li class="active">'.ucfirst($link[$nb-1]['name']).'</li></ol>';

      return $s;
  }

    public static function subscription($key)
    {
        echo
            '<div class="newsletter">
                <div class="container">
                    <div class="agileinfo_newsletter_left">
                        <h3>Abonnez-vous !</h3>
                    </div>
                    <div class="agileinfo_newsletter_right">
                        <form action="'.Glob::DOMAIN.'subscription" method="post">
                            <input class="email" name="email" type="email" placeholder="Votre Email..." required>
                            <input type="hidden" name="key" value="'.$key.'">
                            <input type="submit" value="S\'abonner">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>';
    }

    static public function contact($key)
    {


        echo '<div class="footer" id="contact" style="background:#111;">
		<div class="container" >
			<h2 class="agileinfo_header" style="color: white">Contact</h2>
			<p class="agileits_dummy_para" style="color: white">Contacter le club ESIMAT ...</p>
				<div class="agileits_mail_grids">
				<div class="col-md-7 agileits_mail_grid_left">
					<form action="contact" method="post">
						<h4 >Votre nom *</h4>
						<input type="text" name="name" placeholder="Votre nom" required>
						<h4>Adress email*</h4>
						<input type="email" name="email" placeholder="Votre adresse email" required>
						<h4>Message *</h4>
						<textarea placeholder="Votre Message..." name="message" required></textarea>
						<input type="hidden" value="'.$key.'" name="key">
						<input type="submit" value="Envoyer">
					</form>
				</div>
				<div class="col-md-5 agileits_mail_grid_right">
					<div class="agile-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d865.839200036845!2d3.1711340786054616!3d36.7051485466274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sfr!2sdz!4v1514384908392"  allowfullscreen></iframe>
					</div>
					<div class="left-agileits" id="wh" >
						<h3 >Adresse</h3>
							<ul style="color: white;">
								<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> BP 68M OUED SMAR, 16309, EL HARRACH، 16309، الجزائر</li>
								<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:contact@esi-mat.com" style="color: white;">contact@esi-mat.com</a></li>
							</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	
		</div>
	</div>';
    }
 public static function date($date)
 {
     return'<i class="fa fa-calendar" aria-hidden="true"></i> <span title="Date de publication ">'.Glob::getDate($date).'</span>';
 }

 public static function notFound()
{
    echo '<br><h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span>Not found.</h3><br>';
}

    public static function showMessage($rep)
    {
        echo '<br><br><h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span>'.$rep.'</h3><br><br>';
    }

}

?>