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
            // TRAITEMENT ... REQUETE BDD ...
            view\View::startPage(0,"ESIMAT | HOME",self::getUrlUser(),"noImage",['flexslider.css']);
            view\View::header();
            // VUE SPECIFIQUE ...
            view\View::contact();
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
            // TRAITEMENT ... REQUETE BDD ...


            view\View::startPage($pageType,self::getTitleByPageType($pageType),self::getUrlUser(),"noImage");
            view\View::header($pageType);
            // VUE SPECIFIQUE ...
            $data = array(
                array(
                    "id" => 1,
                    "title" => "topic 1",
                    "type" => 1,
                    "images" => "g1.jpg;g4.jpg;g8.jpg;g1.jpg",
//                            explode(";", "g1.jpg;g4.jpg;g8.jpg;g1.jpg",0)[0]
                    "body" => "Bacon ipsum dolor amet alcatra doner cupim beef ribs meatloaf ham hock, pastrami sirloin pancetta andouille venison. Tri-tip prosciutto ham hock brisket frankfurter. Ground round boudin flank biltong landjaeger tongue tenderloin prosciutto. Tenderloin short ribs ground round meatloaf landjaeger ham. Turducken picanha shoulder, frankfurter jerky prosciutto bacon cupim sirloin biltong ball tip strip steak alcatra landjaeger.",
                    "date_post" => "12/12/2012"
                )
            );
            $infosPagin=Logic::getInfosPagine($page,50);
            view\Topic::topicsPagin($data, $pageType, $infosPagin['start'], $page, $infosPagin['end']);
            view\View::subscription();
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
            $data = array(
                "id" => 1,
                "title" => "Article 1",
                "type" => 1,
                "images" => "g1.jpg;g4.jpg;g8.jpg;g1.jpg",
                "videos" => "",
                "body" => "Spicy jalapeno bacon ipsum dolor amet shank pork belly kevin ham salami, pancetta buffalo pastrami. Pork belly meatball pig cow pastrami short loin filet mignon pork loin bacon leberkas shoulder. Bresaola kielbasa cow ground round ball tip brisket cupim prosciutto tri-tip short loin frankfurter shoulder. Boudin tongue pork chop ground round, beef picanha pork belly tail. Tri-tip ribeye biltong, jerky fatback frankfurter pig ham hock tenderloin turkey shankle spare ribs. Porchetta tri-tip doner, meatball buffalo chicken capicola ball tip cupim. Corned beef turkey rump capicola swine, andouille biltong drumstick tongue picanha kielbasa.
Ground round boudin swine pork belly, short ribs tri-tip corned beef spare ribs biltong salami shank filet mignon fatback jerky. Cow ground round frankfurter pork belly, meatloaf hamburger prosciutto venison beef ribs bacon shoulder shankle picanha t-bone. Short loin frankfurter burgdoggen short ribs tenderloin prosciutto. Buffalo tongue hamburger short loin salami, spare ribs prosciutto chuck beef ribs. Alcatra capicola prosciutto filet mignon short ribs meatloaf andouille tri-tip porchetta.
Capicola ribeye bacon alcatra tail turkey beef sausage burgdoggen porchetta. Kielbasa pancetta swine, shoulder hamburger chicken corned beef leberkas picanha bresaola doner pastrami. Jowl cupim buffalo, burgdoggen prosciutto picanha t-bone meatloaf kielbasa filet mignon bacon pork loin swine bresaola pancetta. Sausage ribeye corned beef short loin.

Bacon drumstick landjaeger, pork belly tail leberkas salami fatback venison corned beef brisket ball tip meatball shankle t-bone. Filet mignon burgdoggen swine bresaola tongue andouille. Buffalo chuck ground round ball tip filet mignon, landjaeger pastrami burgdoggen jowl swine porchetta picanha. Cupim salami jowl doner meatloaf frankfurter pork loin. Kevin pancetta pork shoulder.
Burgdoggen picanha jowl turkey shoulder cow, beef beef ribs kevin andouille doner ham hock chuck. Brisket filet mignon tail kevin, tongue pork chop short loin pastrami boudin. Pancetta filet mignon tail chuck flank. Pastrami pork belly alcatra, beef ribs chuck ham turkey ground round. Ribeye pastrami pancetta meatball swine venison. Alcatra buffalo venison ham flank pancetta. Jowl sausage pork corned beef, pig pork loin pork chop landjaeger shankle.
Does your lorem ipsum text long for something a little meatier? Give our generator a try… it’s tasty!",
                "date_post" => "12/12/2012"
            );

            view\View::startPage($pageType, $data['title'] ,self::getUrlUser(), "noImage",['lightcase.css']);
            view\View::header($pageType);

            view\Topic::topicDetails($data, $pageType);
            view\View::endPage(['lightcase.js','jquery.events.touch.js','diapo.js']);
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

            view\View::startPage($pageType,self::getTitleByPageType($pageType),self::getUrlUser(),"noImage");
            view\View::header($pageType);
            // VUE SPECIFIQUE ...
            $data = array(
                array(
                    "id" => 1,
                    "title" => "Cours ANAD",
                    "type" => 1,
                    "image" => "g1.jpg",
                    "source" => "file1.pdf",
                    "date_post" => "12/12/2012"
                ),
                array(
                    "id" => 1,
                    "title" => "Spotify",
                    "type" => 1,
                    "image" => "g2.jpg",
                    "source" => "SpotifySetup.exe",
                    "date_post" => "12/12/2012"
                ),
                array(
                    "id" => 1,
                    "title" => "Spotify no img",
                    "type" => 1,
                    "image" => "",
                    "source" => "SpotifySetup.exe",
                    "date_post" => "12/12/2012"
                )
            );
            $infosPagin=Logic::getInfosPagine($page,50);
            view\Download::downloadsPagin($data, $pageType,$infosPagin['start'], $page, $infosPagin['end']);
            view\View::subscription();
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

            view\View::startPage(30, "ESIMAT | Album", self::getUrlUser(), "noImage");
            view\View::header(30);

            $data = array(
                array("id" => 1, "title" => "album 1", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "2018-11-10"),
                array("id" => 2, "title" => "album 8", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "2018-06-10"),
                array("id" => 3, "title" => "album 2", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "2017-05-1"),
                array("id" => 1, "title" => "album 3", "image" => "g1.jpg", "description" => "bla bla bla", "date_post" => "2018-01-10"),
                array("id" => 2, "title" => "album 4", "image" => "g1.jpg", "description" => "bla bla bla  blabla bla blabla bla b blabla bla blabla bla b blabla bla blabla bla b", "date_post" => "12/12/2012"),
                array("id" => 3, "title" => "album 6", "image" => "g1.jpg", "description" => "bla blaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla", "date_post" => "12/12/2012")
            );
            $infosPagin=Logic::getInfosPagine($page,3);
            view\Album::albumsPagin($data,$infosPagin['start'], $page, $infosPagin['end']);
            view\View::subscription();
            view\View::endPage();
        }
    }

    public static function album($id)
    {
        Model::Init();
        if (Model::$can_connect) {

            view\View::startPage(31, "ESIMAT | Album", self::getUrlUser(), "noImage",['lightcase.css']);
            view\View::header(31);

            $data = array(array("image"=>"g4.jpg","title"=>"Titre 1"),
                array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4"),
            array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4") ,
            array("image"=>"g4.jpg","title"=>"Titre 3"),
                array("image"=>"g8.jpg","title"=>"Titre 4"),
                array("image"=>"g4.jpg","title"=>"Titre 4")
                );
            view\Album::imagesAlbum($data,"le premier evenment",$id,"Cette evenement est ...");
            view\View::endPage(['lightcase.js','jquery.events.touch.js','diapo.js']);
        }
    }



//remarque
/*
 * on peut mettre le header dans la metthod start_page dans (class use app\view\view) mais pour
 * le moment on sépare pour avoir une vue logique...
 */




}