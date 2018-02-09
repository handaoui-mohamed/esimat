<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 09/02/2018
 * Time: 16:21
 */

namespace admin\src\view;


class File
{
    public static function showFileForm(){
        echo '
        <div style="padding:20px">
            <h3 class="blank1">Ajouter un nouveau fichier</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-file-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="title" id="title" placeholder="Titre du fichier">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-2 control-label">Catégorie</label>
                            <div class="col-sm-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="0" name="type" checked> Scientifique</label>
                                </div>
                                <div class="radio-inline">
                                        <label><input type="radio" value="1" name="type"> Echequienne</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="im" class="col-sm-2 control-label">Image (couverture)</label>
                            <div class="col-sm-4">
                                <input accept="image/*" type="file" id="im" name="im">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="file" class="col-sm-2 control-label">Fichier</label>
                            <div class="col-sm-4">
                                <input type="file" id="file" name="file">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2" style="padding-left: 20px;">
                                <button class="btn-success btn" type="submit">Confirmer</button>
                                <button class="btn-inverse btn" type="reset" id="form-reset">Réinitialiser</button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2 progress" id="progress-container" style="display: none">
                              <div class="progress-bar" id="topic-progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
}