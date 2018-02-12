<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 11/02/2018
 * Time: 00:08
 */

namespace app\view;


use app\Glob;

class Home
{
    public static function HisoriqueHome()
    {
        echo'<div class="events">
		<div class="container">
			<h3 class="agileinfo_header">Historique du club</h3>
			<p class="agileits_dummy_para">événements marquants du club</p>
			<div class="w3ls_event_grids">
				
				<div class="col-md-6 wthree_events_grid_left">
					<div class="wthree_events_grid_left1">
						<div class="wthree_events_grid_left1_grid">
							<div class="col-xs-4 wthree_events_grid_left1_gridl">
								<p>'.Glob::getDate('20-09-2015').'</p>
							</div>
							<div class="col-xs-8 wthree_events_grid_left1_gridr">
								<h4><a href="#" data-toggle="modal" data-target="#myModal">Création</a></h4>
								<p>Le club ESIMAT a ouvert ses portes.</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="wthree_events_grid_left1">
						<div class="wthree_events_grid_left1_grid">
							<div class="col-xs-4 wthree_events_grid_left1_gridl">
								<p>En 2016</p>
							</div>
							<div class="col-xs-8 wthree_events_grid_left1_gridr">
								<h4><a href="#" data-toggle="modal" data-target="#myModal">CONFERENCE SUR LE CHESS COMPUTING</a></h4>
								<p>DEUXIEME CONFERENCE SUR LE CHESS COMPUTING 2016</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="wthree_events_grid_left1">
						<div class="wthree_events_grid_left1_grid">
							<div class="col-xs-4 wthree_events_grid_left1_gridl">
								<p>En  2017</p>
							</div>
							<div class="col-xs-8 wthree_events_grid_left1_gridr">
								<h4><a href="#" data-toggle="modal" data-target="#myModal">CONFERENCE SUR LE CHESS COMPUTING</a></h4>
								<p>TROISIEME EDITION DE LA CONFERENCE DEBAT SUR LE CHESS COMPUTING</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="col-md-1">
					
				</div>
				<div class="col-md-5 wthree_events_grid_right">
					<img src="'.Glob::DOMAIN.'static/images/logoP.png">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>';
    }

    public  static function apropos()
    {
        echo '<div class="container" id="apropos" style="margin-top: 50px;">
			<div class="footer-grids">
				<p class="footer-heading">
					<h3 class="agileinfo_header">À PROPOS</h3>
					<p class="agileits_dummy_para">
					Le club ESIMAT a ouvert ses portes le dimanche 20/09/2015. 
					<p class="agileits_dummy_para">Les étudiants peuvent venir jouer ou s’initier aux jeux d’échecs tous les jours entre 12h et 13h.</p>
					 <br>
					 <p class="agileits_dummy_para">Le club a organisé deux évènements :  le Tournoi du 1er Novembre ainsi que le Tournoi des grandes écoles du 1er Mai.
</p></p>
</div></div></div>';

    }
}