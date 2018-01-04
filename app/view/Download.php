<?php

namespace app\view;
use app\Glob;


class Download
{
    private static $dirImgDownloads = "images/album/"; // just for testing with album dir TODO : "images/downloads/"
    private static $dirDownloads = "downloads/";
    private static $defaultDownloadImg = "g3.jpg"; //TODO : "default-img.jpg"

    private static function downloadPaginPresentation($download)
    {
        if (!$download['image']) $download['image'] = self::$defaultDownloadImg;

        return
            '<div class="col-md-3 list-grid" style="margin-bottom: 20px">
                <div class="list-img">
                    <img src="'.Glob::DOMAIN.self::$dirImgDownloads.$download['image'].'" class="img-responsive" alt="image telechargement">
                    <div class="textbox"></div>
                </div>						
                <h4>'.$download['title'].'</h4>
                <h6  style="margin-bottom: 10px;">'.View::date($download['date_post']).'</h6>
                <a class="read-more-link" target="_blank" href="'.Glob::DOMAIN.self::$dirDownloads.$download['source'].'"><i class="fa fa-download"></i> Telecharger</a>
            </div>';
    }

    public static function downloadsPagin($downloads, $pageType, $start,$curpage,$end,$pagin=true)
    {
        $topicsLink = $pageType==12 ? 'echiquienne':'scientifique';

        echo '<div class="overview w3-2" style="padding-top: 5px;">
			    <div class="container">
                 '.View::getlink([["name"=>'téléchargements ('.$topicsLink.')' ,"link"=>$topicsLink."/downloads/"] , ["name"=>"Page ".$curpage] ]).'
                    <h3 class="agileinfo_header"><span class="fa fa-cloud-download"></span> Les article a telecharger</h3>
                    <p class="agileits_dummy_para">Page '.$curpage.'</p>
                    <div class="overview-grids">';

        $nb_downloads = count($downloads);

        for ($i = 0; $i < $nb_downloads; $i++) {
            echo self::downloadPaginPresentation($downloads[$i]);
        }
        echo "</div></div>";// .overview-grids
        if ($pagin) {
            echo View::pagine($pageType, $start, $curpage, $end);
        }
        echo '</div>';
    }
}