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
									<li><a href="#contact" class="scroll">Contact</a></li>
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
					
					<h1>
					<a class="navbar-brand" href="'.Glob::DOMAIN.'"><img src="'.Glob::DOMAIN.self::$staticFilesDir.'images/logo_.png" style="display: inline-block;width: 90px;height: 90px;border-radius: 100% 100%;"> <span> ESI </span>MAT</a></h1>
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
		<div class="container" style="padding: 0;">
			<div class="agileinfo">
		    
				<div class="footer-heading">
				    <div class="col-lg-3">
                        <img src="'.Glob::DOMAIN.self::$staticFilesDir.'images/logo.png" style="display: inline-block;width: 50%;height: 50%;border-radius: 100% 100%;">
                        <div style="color: white;margin-top: 10px;">
                           <p>© '.date("Y").' ESIMAT  Club d\'Echecs <br><br>Tous les droits sont réservés.</p> 
                        </div>
                    </div>
                    
					<div class="footer-icons"  id="MSociaux">
                        <ul>
                            <p class="agileits_dummy_para"> <b>Suivez nous sur les réseaux sociaux !</b></p>
                            <br><br>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a><span>Twitter</span></li>
                            <br><li><a href="#" class="twitter facebook"><i class="fa fa-facebook"></i></a><span>Facebook</span></li>
                            <li><a href="#" class="twitter chrome"><i class="fa fa-google-plus"></i></a><span>Google +</span></li>
                        </ul>
			    	</div>
	
				</div>
				
			</div>
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
            	    <li><a href="'.Glob::DOMAIN.'">ESIMAT</a></li>';

      for ($i=0;$i<$nb-1;$i++)
      {
        $s.='<li><a href="'.Glob::DOMAIN.$link[$i]['link'].'">'.$link[$i]['name'].'</a></li>';
      }

      $s.= '<li class="active">'.$link[$nb-1]['name'].'</li></ol>';

      return $s;
  }

    public static function subscription()
    {
        echo
            '<div class="newsletter">
                <div class="container">
                    <div class="agileinfo_newsletter_left">
                        <h3>Abonnez-vous !</h3>
                    </div>
                    <div class="agileinfo_newsletter_right">
                        <form action="#" method="post">
                            <input class="email" type="email" placeholder="Votre Email..." required>
                            <input type="submit" value="S\'abonner">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>';
    }

    static public function contact()
    {
        echo '<div class="footer" id="contact">
		<div class="container">
			<h2 class="agileinfo_header">Contact</h2>
			<p class="agileits_dummy_para">Contacter le club ESIMAT ...</p>
				<div class="agileits_mail_grids">
				<div class="col-md-7 agileits_mail_grid_left">
					<form action="#" method="post">
						<h4>Votre nom *</h4>
						<input type="text" name="Name" placeholder="Name..." required="">
						<h4>Adress email*</h4>
						<input type="email" name="Email" placeholder="Email..." required="">
						<h4>Numero de téléphone</h4>
						<input type="text" name="Phone" placeholder="Phone...">
						<h4>Message *</h4>
						<textarea placeholder="Message..." name="Message" required=""></textarea>
						<input type="submit" value="Envoyer">
					</form>
				</div>
				<div class="col-md-5 agileits_mail_grid_right">
					<div class="agile-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d865.839200036845!2d3.1711340786054616!3d36.7051485466274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sfr!2sdz!4v1514384908392"  allowfullscreen></iframe>
					</div>
					<div class="left-agileits">
						<h3>Adresse</h3>
							<ul>
								<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 7th Street, Melbourne City, Australia.</li>
								<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:info@example.com">info@example.com</a></li>
								<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> (4584) 5689 0254 128</li>
							</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
	
		</div>
	</div>';
    }

}

?>