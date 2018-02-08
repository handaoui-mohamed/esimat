<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 07/02/2018
 * Time: 21:35
 */

namespace admin\src\view;

use app\Glob;
class Home
{
    public static function showHome($states=[])
    {
        echo
            self::showStat($states)
            .self::showShortcuts();
    }

    private static function showShortcuts(){
        return '
            <div style="padding-top: 0" id="page-wrapper">
				<div class="graphs">
					<div class="col_3">
						<div class="col-md-4 page-shortcuts">
						    <h3>Gestion des articles</h3>
						    <ul>
						        <li><a href="'.Glob::DOMAIN_ADMIN.'list/topics">Liste des articles</a></li>
						        <li><a href="'.Glob::DOMAIN_ADMIN.'post/topic">Ajouter un nouveau article</a></li>
                            </ul>
						</div>
						<div class="col-md-4 page-shortcuts">
						    <h3>Gestion des albums</h3>
						    <ul>
						        <li><a href="">Liste des albums</a></li>
						        <li><a href="">Ajouter un nouveau album</a></li>
                            </ul>
						</div>
						<div class="col-md-4 page-shortcuts">
						    <h3>Gestion des fichiers</h3>
						    <ul>
						        <li><a href="">Liste des fichiers</a></li>
						        <li><a href="">Ajouter un nouveau fichier</a></li>
                            </ul>
						 </div>
						<div class="clearfix"> </div>
					</div>
                </div>
            </div>
        ';
    }

    private static function showStat($states)
    {
        $articleTypes = array('Scientifique','Echequienne');

        $article = array( 0,0 );

        if(!empty($states['article'][0])){
            $article[$states['article'][0]['type']] = $states['article'][0]['nb'];

            if(!empty($states['article'][1])){
                $article[$states['article'][1]['type']] = $states['article'][1]['nb'];
            }
        }

        return '
            <div id="page-wrapper">
				<div class="graphs">
					<div class="col_3">
					
						<div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i  style="color: #2ecc71"  class="fa fa-file-text"></i>
								<div class="stats">
								  <h5 title="Vous avez '.$article[0].' article(s) Scientifique(s) 
Et '.$article[1].' article(s) Echequienne(s)">'.($article[0]+$article[1]).'</h5>
								  <div style="background-color: #2ecc71" class="grow grow3">
									<p>Nombre d\'article</p>
								  </div>
								</div>
							</div>
						 </div>
						<div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-users"></i>
								<div class="stats">
								  <h5>'.$states['sub'].'</h5>
								  <div class="grow grow1">
									<p>Nombre d\'abonnées</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i style="color: #e74c3c;" class="fa fa-picture-o"></i>
								<div class="stats">
								  <h5>'.$states['album'].'</h5>
								  <div style="background-color: #e74c3c" class="grow grow3">
									<p>Nombre d\'albums</p>
								  </div>
								</div>
							</div>
						 </div>
						 
						<div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i style="color: #e67e22;" class="fa fa-cloud-download"></i>
								<div class="stats">
								  <h5>'.$states['download'].'</h5>
								  <div style="background-color: #e67e22" class="grow grow3">
									<p>article a télécharger</p>
								  </div>
								</div>
							</div>
						 </div>
						 
						 
						 <div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i style="color: #34495e" class="fa fa-envelope"></i>
								<div class="stats">
								  <h5>'.$states['message'].'</h5>
								  <div style="background-color: #34495e" class="grow grow3">
									<p>Nombre de Messages</p>
								  </div>
								</div>
							</div>
						 </div>
						 
						<div class="col-md-2 widget widget1">
							<div class="r3_counter_box">
								<i style="color: #7f8c8d" class="fa fa-bar-chart"></i>
								<div class="stats">
								  <h5>'.$states['visite'].'</h5>
								  <div style="background-color: #7f8c8d;" class="grow">
									<p>Nombre de visite</p>
								  </div>
								</div>
							</div>
						</div>
					    
						<div class="clearfix"> </div>
					</div>
                </div>
            </div>
        ';
    }
}