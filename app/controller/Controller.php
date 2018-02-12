<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 22/12/2017
 * Time: 14:14
 */

namespace app\controller;
use app\view;
use app\model\Model;


class Controller
{

    private static function getUrlUser()
    {
        return $_url= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    public static function index()
    {
        Model::Init();
        if (Model::$can_connect)
        {
            Model::incVisite();

            view\View::startPage(0,"ESIMAT | HOME",self::getUrlUser(),"noImage",['home.css','flexslider.css']);
            view\View::header();

            view\Topic::topicsHome(Model::getLastTopics(3,0),Model::getLastTopics(3,1));
            view\Home::HisoriqueHome();
            $_SESSION['keyForm']=rand(0,1000000).time().rand(0,10000000).sha1('kklcdsdcscd'.time());
            view\View::contact($_SESSION['keyForm']);
            view\Home::apropos();
            view\View::endPage(['jquery.flexslider.js','index.js','jquery.countup.js']);
        }
    }
    /**
     * @param int $pagetype
     * @return string
     */
    private static function getTitleByPageType($pagetype=0)
    {
        $pageTitles=[
            "0"=>"Home",
            '10'=>'Échiquienne',
            '12'=>'Téléchargement (Échiquienne)',
            '20'=>'Scientifique',
            '22'=>'Téléchargement (Scientifique)'
        ];
        return 'ESIMAT | '.$pageTitles[$pagetype];
    }

    private static function topics($page, $pageType){
        Model::Init();
        if (Model::$can_connect)
        {

            Model::incVisite();
            view\View::startPage($pageType,self::getTitleByPageType($pageType),self::getUrlUser(),"noImage");
            view\View::header($pageType);
            // VUE SPECIFIQUE ...
            if ($pageType==10)
            {
                $data=Model::getEchiquienneTopics($page);
                if (count($data)>0)
                {
                    $infosPagin=Logic::getInfosPagine($page,Model::getNbPagesEchiquienne());
                    view\Topic::topicsPagin($data, $pageType, $infosPagin['start'], $page, $infosPagin['end']);
                    $_SESSION['keyFormSub']=rand(0,20000).sha1(time()."csdcç-(").rand(5000,10000000);
                    view\View::subscription($_SESSION['keyFormSub']);
                }
                else
                {
                    self::notFound();
                }

            }
            else
            {
                $data=Model::getScientifiqueTopics($page);
                if (count($data)>0)
                {
                    $infosPagin=Logic::getInfosPagine($page,Model::getNbPagesScientifique());
                    view\Topic::topicsPagin($data, $pageType, $infosPagin['start'], $page, $infosPagin['end']);
                    $_SESSION['keyFormSub']=rand(0,20000).sha1(time()."csdcç-(").rand(5000,10000000);
                    view\View::subscription($_SESSION['keyFormSub']);
                }
                else
                {
                    self::notFound();
                }
            }

            view\View::endPage();
        }
    }

    public static function echiquienneTopics($page=1)
    {
        self::topics($page, 10);
    }

    public static function scientifiqueTopics($page=1)
    {
        self::topics($page, 20);
    }

    private static function topic($id, $pageType)
    {
        Model::Init();
        if (Model::$can_connect) {
            Model::incVisite();
            $data=Model::getTopic($id);
            if (!empty($data['id']))
            {
                view\View::startPage($pageType, $data['title'] ,self::getUrlUser(), "noImage",['lightcase.css']);
                view\View::header($pageType);
                view\Topic::topicDetails($data, $pageType);
                view\View::endPage(['lightcase.js','jquery.events.touch.js','diapo.js']);
            }else
            {
                include 'errors/404.html';
                http_response_code(404);
            }


        }
    }

    public static function echiquienneTopic($id)
    {
        self::topic($id, 11);
    }

    public static function scientifiqueTopic($id)
    {
        self::topic($id, 21);
    }

    private static function downloads($page, $pageType){
        Model::Init();
        if (Model::$can_connect)
        {
            // TRAITEMENT ... REQUETE BDD ...
            $type=($pageType==12)?1:0;
            Model::incVisite();
            view\View::startPage($pageType,self::getTitleByPageType($pageType),self::getUrlUser(),"noImage");
            view\View::header($pageType);
            // VUE SPECIFIQUE ...

            $data=Model::getDownloads($page,$type);
            if (!empty($data[0]))
            {
                $infosPagin=Logic::getInfosPagine($page,Model::getNbPagesDownload($type));
                view\Download::downloadsPagin($data, $pageType,$infosPagin['start'], $page, $infosPagin['end']);
                $_SESSION['keyFormSub']=rand(0,20000).sha1(time()."csdcç-(").rand(5000,10000000);
                view\View::subscription($_SESSION['keyFormSub']);
            }
            else
            {
                self::notFound();
            }

            view\View::endPage();
        }
    }

    public static function echiquienneDownloads($page=1){
        self::downloads($page, 12);
    }

    public static function scientifiqueDownloads($page=1){
        self::downloads($page, 22);
    }


    public static function albums($page=1)
    {
        Model::Init();
        if (Model::$can_connect) {
            Model::incVisite();
            view\View::startPage(30, "ESIMAT | Album", self::getUrlUser(), "noImage");
            view\View::header(30);


            $data=Model::getAlbums((int)$page);
            if (!empty($data[0]))
            {
                $infosPagin=Logic::getInfosPagine((int)$page,Model::getNbPagesAlbums());
                view\Album::albumsPagin($data,$infosPagin['start'], $page, $infosPagin['end']);
                $_SESSION['keyFormSub']=rand(0,20000).sha1(time()."csdcç-(").rand(5000,10000000);
                view\View::subscription($_SESSION['keyFormSub']);
            }
            else
            {
                self::notFound();
            }

            view\View::endPage();
        }
    }

    public static function album($id)
    {
        Model::Init();
        if (Model::$can_connect) {
            Model::incVisite();

            $data =Model::getAlbumImages((int)$id);
            if (!empty($data[0]))
            {
                $album=Model::getAlbum($id);
                if (!empty($album['title']))
                {
                    $title=$album['title'];
                }
                else{$title="";}

                view\View::startPage(31, "ESIMAT | Album", self::getUrlUser(), "noImage",['lightcase.css']);
                view\View::header(31);
                view\Album::imagesAlbum($data,
                    $title,
                    $id,
                    !empty($album['date_post'])?$album['date_post']:'inconnue',
                    !empty($album['description'])?$album['description']:'');
                view\View::endPage(['lightcase.js','jquery.events.touch.js','diapo.js']);

            }
            else
            {
                $album=Model::getAlbum((int)$id);
                if (!empty($album['id']))
                {
                    view\View::startPage(31, "ESIMAT | Album", self::getUrlUser(), "noImage",['lightcase.css']);
                    view\View::header(31);
                    view\Album::vide();
                    view\View::endPage();
                }
                else
                {
                    http_response_code(404);
                    include 'errors/404.html';
                }


            }


        }
    }


    private  static function notFound()
    {
        view\View::notFound();
        http_response_code(404);
    }

    public  static  function  contact()
    {
        Model::Init();
        if (Model::$can_connect) {
            view\View::startPage(-1, "ESIMAT | Contact", self::getUrlUser(), "noImage");
            view\View::header(-1);
            if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['message'])) {

                if (!empty($_POST['key']) && !empty($_SESSION['keyForm'])) {

                    if ($_POST['key'] == $_SESSION['keyForm']) {

                        if (self::isemail( $_POST['email']))
                        {

                            $message = htmlspecialchars($_POST['message']);
                            $name = htmlspecialchars($_POST['name']);
                            $email = strtolower(htmlspecialchars($_POST['email']));
                            $rep = "Votre message a bien été envoyé";
                            Model::addNewMessage($email, $name, $message);
                            $rep = "<span>Votre message a bien été envoyé</span>";

                        } else {
                            $rep = "Informations non valides";
                        }

                    } else {

                        $rep = "Votre message a bien été envoyé";
                    }
                } else {

                    $rep = "Votre message a bien été envoyé";

                }
            } else {
                $rep = "Informations non valides";
            }
            view\View::showMessage($rep);
            view\View::endPage();
        }
    }

    public  static function isemail($email)
    {
        return preg_match('#^[a-z0-9_-]+@[a-z0-9_-]+\.[a-z0-9_-]{2,6}$#i', $_POST['email']);
    }

    public  static  function  subscription()
    {
        view\View::startPage(-1, "ESIMAT | Abonnement", self::getUrlUser(), "noImage");
        view\View::header(-1);
        $message="";
        Model::Init();
        if (Model::$can_connect) {
            if (!empty($_POST['email'])) {

                if (!empty($_POST['key']) && !empty($_SESSION['keyFormSub'])) {

                    if ($_POST['key'] == $_SESSION['keyFormSub']) {
                        if (self::isemail($_POST['email'])) {
                            $email = strtolower(htmlspecialchars($_POST['email']));
                            $exsiteSub = Model::getSubByEmail($email);
                            if (empty($exsiteSub['email'])) {
                                Model::addSub($email);
                                $message = "Vous êtes abonné.";
                            } else {
                                $message = "Vous êtes déjà abonné à ESIMAT";
                        }

                        } else {
                            $message = "Adress email non valide.";
                        }

                    } else {
                        $message = "Information non valide.";
                    }
                } else {
                    $message = "Information non valide.";
                }
            } else {
                $message = "Information non valide.";
            }
            view\View::showMessage($message);
            view\View::endPage();
        }
    }
//remarque
/*
 * on peut mettre le header dans la metthod start_page dans (class use app\view\view) mais pour
 * le moment on sépare pour avoir une vue logique...
 */




}