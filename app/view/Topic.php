<?php

namespace app\view;
use app\Glob;


class Topic
{
    private static $topicBodyPreviewLength = 200;
    private static $dirImgTopics= "images/articles/"; // just for testing with album dir TODO : "images/topics/"


    private static function topicPaginPresentation($topic,$pagetype)
    {
        $topicImage = explode(";", $topic['imagesmin'])[0];
        $topicDetailsLink = Glob::DOMAIN.($pagetype==10 ? 'echiquienne':'scientifique').'/article/'.$topic['id'];
        $topicBodyPreview = substr($topic['body'], 0, self::$topicBodyPreviewLength);
        $topicBodyPreview .= strlen($topic['body']) > self::$topicBodyPreviewLength ? " ..." : ".";

        return
            '<div class="col-md-4 list-grid" style="margin-bottom: 20px">
                <div class="list-img">
                    <img src="'.Glob::DOMAIN.self::$dirImgTopics.'min/'.$topicImage.'" class="img-responsive" alt="image d\'article">
                    <div class="textbox"></div>
                </div>						
                <h4>'.$topic['title'].'</h4>
                <h6>'.View::date($topic['date_post']).'</h6>
                <p>'.$topicBodyPreview.'</p>
               <a class="read-more-link" href="'.$topicDetailsLink.'">Lire plus</a>
            </div>';
    }

    public static function topicsHome($topicsScientifique,$topicsEchiquinne)
    {


        echo '<div class="overview w3-2" style="padding-top: 50px;"> 
        <div class="container">
        <h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span>Scientifique</h3>
        <p class="agileits_dummy_para">Les derniers articles et événements dans la cétégorie scientifique</p>
        <div class="overview-grids">';

        $nb=count($topicsScientifique);
        for ($i=0;$i<$nb;$i++)
        {
            echo self::topicPaginPresentation($topicsScientifique[$i],10);
        }
        echo '</div></div></div>';
        echo '<div class="overview w3-2" style="padding-top: 5px;"> 
        <div class="container">
        <h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span>échiquienne</h3>
        <p class="agileits_dummy_para">Les derniers articles et événements dans la cétégorie échiquienne</p>
        <div class="overview-grids">';
        $nb=count($topicsEchiquinne);
        for ($i=0;$i<$nb;$i++)
        {
            echo self::topicPaginPresentation($topicsEchiquinne[$i],10);
        }
        echo '</div></div></div>';
    }


    public static function topicsPagin($topics, $pageType, $start,$curpage,$end,$pagin=true)
    {
        $topicsLink = $pageType==10 ? 'echiquienne':'scientifique';

        echo '<div class="overview w3-2" style="padding-top: 5px;">
			    <div class="container">
                 '.View::getlink([["name"=>$topicsLink ,"link"=>$topicsLink."/articles/"] , ["name"=>"page ".$curpage] ]).'
                    <h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span> Les derniers articles du club</h3>
                    <p class="agileits_dummy_para">Page '.$curpage.'</p>
                    <div class="overview-grids">';

        $nb_topics = count($topics);

        for ($i = 0; $i < $nb_topics; $i++) {
            echo self::topicPaginPresentation($topics[$i],$pageType);
        }
        echo "</div></div>";// .overview-grids
        if ($pagin) {
            echo View::pagine($pageType, $start, $curpage, $end);
        }
        echo '</div>';
    }

    private static function topicDetailsBody($body){
        $paragraphs = explode("\n",$body);
        $nb_paragraphs = count($paragraphs);
        for ($i=0;$i<$nb_paragraphs;$i++){
            if(strlen($paragraphs[$i]) > 1){
                echo '<p class="topic-body-paragraph">'. $paragraphs[$i].'</p>';
            }else echo '<br>';
        }
    }

    private static function topicDetailsImage($image,$imageMin)
    {
        $dirImgTopicsMin = Glob::DOMAIN.self::$dirImgTopics.'min/';
        $dirImgTopicsOrigin = Glob::DOMAIN.self::$dirImgTopics;

        return '<div class="w3_agile_portfolio_grid1">
                    <a href="'.$dirImgTopicsOrigin.$image.'" class="showcase" data-rel="lightcase:myCollection:slideshow">
                        <div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">	
                            <div class="w3layouts_port_head">
                            </div>
                            <img src="'.$dirImgTopicsMin.$imageMin.'" alt="image" class="img-responsive" />
                        </div>
                    </a>
                </div>';

    }

    private static function topicDetailsImages($images,$imagesmin){
        $nb_images = count($images);
        echo '<br><h4 class="agileinfo_header"><span class="fa fa-image"></span> Images d\'article</h4>
                <div class="w3ls_portfolio_grids">';

        for ($i=0;$i<$nb_images;$i++){
            echo '<div class="col-md-4 agileinfo_portfolio_grid">'.self::topicDetailsImage($images[$i],$imagesmin[$i]).'</div>';
        }

        echo '</div>';
    }

    public static function topicDetails($topic, $pageType)
    {
        $topicsLink = $pageType == 11 ? 'echiquienne':'scientifique';
        $images = explode(";", $topic['images']);
        $imagesmin=explode(";", $topic['imagesmin']);

        echo
            '<div class="banner-bottom" style="padding-top: 5px;">
                <div class="container">
                    '.View::getlink([["name"=>$topicsLink ,"link"=>$topicsLink."/articles/"]  , ["name"=>$topic['title']] ]).'
                    <div class="agileits_heading_section">
                        <h2 class="agileinfo_header">Article : '.$topic['title'].'</h2>
                        <p class="agileits_dummy_para">Publié '.Glob::getDate($topic['date_post']).'</p>
                    </div>
                    <br>
                    <div class="topic-main-image" style="background-image: url('.Glob::DOMAIN.self::$dirImgTopics.$images[0].')"></div>
                    <br>';

        self::topicDetailsBody($topic['body']);
        self::topicDetailsImages($images,$imagesmin);

        echo '</div></div>';
    }

}