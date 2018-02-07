<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 18:56
 */

namespace admin\src\view;

use app\Glob;

class View
{
    private static $staticFilesDir = 'static/';

    private static function showHeader()
    {
        echo "<h1>From hedear admin </h1><br>DOMAIN:" . \app\Glob::DOMAIN;
    }

    public static function showHome()
    {
        echo "@admin <hr><h1>Vous etes dans le home : </h1>";
    }

    public static function startPage($pageType = 0, $title = 'Home', $arrayCSS = [], $user, $messages = [], $state = 200)
    {
        $StaticFilesDirLink = Glob::DOMAIN . self::$staticFilesDir;

        $nb = count($arrayCSS);

        $css = '';

        for ($i = 0; $i < $nb; $i++)
            $css .= '<link href="' . $StaticFilesDirLink . 'css/' . $arrayCSS[$i] . '" rel="stylesheet" type="text/css" media="all" />';


        echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>' . $title . '</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="' . $StaticFilesDirLink . 'css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
                <link href="' . $StaticFilesDirLink . 'css/our-style.css" rel="stylesheet" type="text/css" media="all" />
                <link rel="stylesheet" href="' . $StaticFilesDirLink . 'css/font-awesome.min.css" />
                <link rel="stylesheet" href="' . $StaticFilesDirLink . 'css/icon-font.min.css" />
                <link rel="stylesheet" href="' . $StaticFilesDirLink . 'css/animate.css" />
                <link href="//fonts.googleapis.com/css?family=Varela+Round&subset=hebrew" rel="stylesheet">
                <link href=\'//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic\' rel=\'stylesheet\' type=\'text/css\'>
                ' . $css . '
            </head>
            <body  class="sticky-header left-side-collapsed">
            ' . self::getSideBar($pageType)
            . self::header($messages, $user);
    }

    private static function setActive($pageType, $hisType)
    {
        $pageState = $pageType == $hisType ? 'active' : '';
        return $pageState;
    }

    /**
     * @param $pageType
     * @return string
     * génère le menu dynamiquement
     */
    private static function getSideBar($pageType)
    {
        $scroll = "";
        if ($pageType == 0) $scroll = 'class="scroll"';
        return '
        <div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="index.html">Easy <span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="index.html"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class="active"><a href="index.html"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
						<li class="menu-list">
							<a href="#"><i class="lnr lnr-cog"></i>
								<span>Components</span></a>
								<ul class="sub-menu-list">
									<li><a href="grids.html">Grids</a> </li>
									<li><a href="widgets.html">Widgets</a></li>
								</ul>
						</li>
						<li><a href="forms.html"><i class="lnr lnr-spell-check"></i> <span>Forms</span></a></li>
						<li><a href="tables.html"><i class="lnr lnr-menu"></i> <span>Tables</span></a></li>              
						<li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>MailBox</span></a>
							<ul class="sub-menu-list">
								<li><a href="inbox.html">Inbox</a> </li>
								<li><a href="compose-mail.html">Compose Mail</a></li>
							</ul>
						</li>      
						<li class="menu-list"><a href="#"><i class="lnr lnr-indent-increase"></i> <span>Menu Levels</span></a>  
							<ul class="sub-menu-list">
								<li><a href="charts.html">Basic Charts</a> </li>
							</ul>
						</li>
						<li><a href="codes.html"><i class="lnr lnr-pencil"></i> <span>Typography</span></a></li>
						<li><a href="media.html"><i class="lnr lnr-select"></i> <span>Media Css</span></a></li>
						<li class="menu-list"><a href="#"><i class="lnr lnr-book"></i>  <span>Pages</span></a> 
							<ul class="sub-menu-list">
								<li><a href="sign-in.html">Sign In</a> </li>
								<li><a href="sign-up.html">Sign Up</a></li>
								<li><a href="blank_page.html">Blank Page</a></li>
							</ul>
						</li>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>';
    }

    private static function getNotifications($messages)
    {
        $nbMessages = count($messages);

        $notifications = '
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope"></i><span class="badge">' . ($nbMessages > 0 ? $nbMessages : ''). '</span>
            </a>
									
            <ul class="dropdown-menu">
                <li>
                    <div class="notification_header"><h3>';

        if ($nbMessages == 0) $notifications .= 'Pas de notifications</h3>';
        else if ($nbMessages == 1) $notifications .= 'Vous avez un nouveau message';
        else $notifications .= 'Vous avez ' . $nbMessages . ' nouveaux messages';

        $notifications .= '</h3> </div> </li> <li style="max-height: 200px;overflow-y: auto;">';

        foreach ($messages as $message) {
            $notifications .= '
            <a href="#">
               <div class="user_img"><img src="' . Glob::DOMAIN . 'static/images/user1.png" alt=""></div>
               <div class="notification_desc">
                    <p style="text-transform: capitalize"><b>'.$message['name'].'</b></p>
                    <p style="text-overflow: ellipsis;width: 180px;overflow: hidden;">' . $message['body'] . '</p>
                    <p><span>'.$message['email'].'</span></p>
                </div>
               <div class="clearfix"></div>	
            </a>';
        }

        $notifications .= '
             </li>
            <li>
                <div class="notification_bottom">
                    <a href="#">Voir tous les messages</a>
                </div> 
            </li>
        </ul>
        ';
        return $notifications;
    }

    private static function header($messages, $user)
    {
        return '
        <!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
						<ul class="nofitications-dropdown">
							<li class="dropdown">
								' . self::getNotifications($messages) . '
							</li>							   		
							<div class="clearfix"></div>	
						</ul>
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span style="background:url(' . Glob::DOMAIN . 'static/images/1.jpg) no-repeat center"> </span> 
										 <div class="user-name">
											<p>' . $user['name'] . '<span>' . $user['role'] . '</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="#"><i class="fa fa-cog"></i>Paramètres</a> </li> 
									<li> <a href="#"><i class="fa fa-user"></i>Profile</a> </li> 
									<li> <a href="logout"><i class="fa fa-sign-out"></i>Déconnexion</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
          	
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		    <!-- //header-ends -->
        ';
    }


    public static function endPage($Arrayscript = [])
    {
        $StaticFilesDirLink = Glob::DOMAIN . self::$staticFilesDir;
        $nb = count($Arrayscript);
        $scripts = '';


        for ($i = 0; $i < $nb; $i++)
            $scripts .= '<script src="' . $StaticFilesDirLink . 'js/' . $Arrayscript[$i] . '"></script>';


        echo '
        </div>
        <footer style="background: rgba(0,0,0,0.1);">
           <p style="height: 30px;line-height: 30px;">© ' . date("Y") . ' <b>ESIMAT</b>  Club <b>d\'Echecs</b> .</p> 
        </footer>
        <script src="' . $StaticFilesDirLink . 'js/wow.min.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/jquery-2.1.4.min.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/jquery.nicescroll.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/classie.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/uisearch.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/ui.js"></script>
        <script src="' . $StaticFilesDirLink . 'js/bootstrap.js"></script>
        ' . $scripts . '
        </body>
        </html>';
    }

}