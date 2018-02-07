<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 15/12/2017
 * Time: 22:14
 */

namespace admin\src\view;
use app\Glob;


class Connexion
{
    public static function showConnexion($key, $error = '')
    {
        echo "
            <!DOCTYPE HTML>
            <html>
            <head>
                <title>Connexion</title>
                <script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                <link href='".Glob::DOMAIN."static/css/login-style.css' rel='stylesheet' type='text/css' />
                <link href='".Glob::DOMAIN."static/css/font-awesome.min.css' rel='stylesheet'> 
                <!----webfonts--->
                <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
            </head> 
             <body class='sign-in-up'>
                <section>
                    <div id='page-wrapper' class='sign-in-wrapper'>
                        <div class='graphs'>
                            <div class='sign-in-form'>
                                <div class='sign-in-form-top'>
                                    <p><span>Se connecter à l'espace</span> <a href='#'>Admin</a></p>
                                </div>
                                <div class='signin'>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='key' value='".$key."'>
                                        <div class='log-input'>
                                            <div class='log-input-left'>
                                               <input type='text' class='user' value='root@mail.com' name='email' placeholder='Votre E-mail' required/>
                                            </div>
                                            <div class='clearfix'></div>
                                        </div>
                                        <div class='log-input'>
                                            <div class='log-input-left'>
                                               <input type='password' class='lock' value='123456' name='pw' placeholder='Votre mot de passe' required/>
                                            </div>
                                            <div class='clearfix'> </div>
                                        </div>
                                        <input style='margin: auto;' type='submit' value='Se connecter'>
                                        <span style='color: red; margin:auto'>".$error."</span>
                                    </form>	 
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </body>
            </html>       
         ";
    }
}