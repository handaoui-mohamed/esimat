<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 27/12/2017
 * Time: 15:39
 */

namespace app\view;
use app\Glob;


class Album
{
private static $dirimgcoveralbum="images/album/";

private static function AlbumPaginPresentation($album)
{
 return '<div class="col-md-4 list-grid" style="margin-bottom: 20px;">
						<div class="list-img">
							<img src="'.Glob::DOMAIN.'static/images/logo.png" class="img-responsive" alt="'.$album['title'].'">
							<div class="textbox"></div>
						</div>						
						<h4>Album: '.$album['title'].'</h4>
						<p>'.View::date($album['date_post']).'<a href="'.Glob::DOMAIN.'album/'.$album['id'].'" class="btn btn-primary" style="float: right">Visualiser</a></p>
						<p style="text-overflow: ellipsis;height:50px;max-height: 50px;overflow: hidden">'.$album['description'].'</p>
					</div>				
 ';
}

public static function albumsPagin($albums,$start,$curpage,$end,$pagin=true)
{

    echo '<div class="overview w3-2" style="padding-top: 5px;">
			<div class="container">
			 '.View::getlink([["name"=>"Albums","link"=>"albums"] , ["name"=>"Page ".$curpage] ]).'
				<h3 class="agileinfo_header"><span class="fa fa-picture-o"></span> Les derniers albums du club</h3>
				<p class="agileits_dummy_para">Page ' . $curpage . '</p>
				<div class="overview-grids">';

    $nb_albums = count($albums);

    for ($i = 0; $i < $nb_albums; $i++) {
        echo self::AlbumPaginPresentation($albums[$i]);
    }
    echo "</div></div>";// .overview-grids
    if ($pagin) {
        echo View::pagine(30, $start, $curpage, $end);
    }
    echo '</div>';
}


    private static function imageAlbum($image_album)
    {

        $dirimgalbummin=Glob::DOMAIN.self::$dirimgcoveralbum.'min/';
        $dirimgalbumorigin=Glob::DOMAIN.self::$dirimgcoveralbum;
     return '<div class="w3_agile_portfolio_grid1">
						<a href="'.$dirimgalbumorigin.$image_album['image'].'" class="showcase" data-rel="lightcase:myCollection:slideshow" title="'.$image_album['title'].'">
							<div class="agileits_portfolio_sub_grid agileits_w3layouts_team_grid">	
								<div class="w3layouts_port_head">
									<h3>'.$image_album['title'].'</h3>
								</div>
								<img src="'.$dirimgalbummin.$image_album['imagemin'].'" alt="'.$image_album['title'].'" class="img-responsive" />
							</div>
						</a>
					</div>';

    }

    public static function imagesAlbum($images,$title,$id,$date,$description="")
    {
      $nb_images=count($images);
      echo '
            <div class="banner-bottom" style="padding-top: 5px;">
            <div class="container">
                '.View::getlink([["name"=>"Albums","link"=>"albums"] , ["name"=>$title,"link"=>"album/".$id] ]).'
                <div class="agileits_heading_section">
                    <h2 class="agileinfo_header">Album : '.$title.'</h2>
                <p class="agileits_dummy_para">'.$description.'</p>
                <p class="agileits_dummy_para"><span class="fa fa-calendar"></span> '.$date.'</p>
                </div>
			<div class="w3ls_portfolio_grids">
			<div class="col-md-4 agileinfo_portfolio_grid">';
      for ($i=0;$i<$nb_images;$i++)
      {
          if ($i%3==0&&$i!=0)
          {
              echo "</div><div class=\"col-md-4 agileinfo_portfolio_grid\">";
          }

          echo self::imageAlbum($images[$i]);
      }


      echo '</div></div></div></div>';

    }

    public static function vide()
    {
        echo '<br><h3 class="agileinfo_header"><span class="fa fa-bookmark-o"></span>Cette album est vide.</h3><br>';
    }

}