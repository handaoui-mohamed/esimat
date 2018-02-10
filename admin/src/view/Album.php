<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 09/02/2018
 * Time: 14:23
 */

namespace admin\src\view;


class Album
{
    public static function showAlbumForm(){
        echo '
        <div style="padding:20px">
            <h3 class="blank1">Ajouter un nouveau album</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-album-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="title" id="title" placeholder="Titre d\'album">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="body" id="body" cols="50" rows="10" style="height: inherit;" class="form-control1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Images</label>
                            <div class="col-sm-4">
                                <input accept="image/*" type="file" id="ims" name="ims[]" multiple>
                            </div>
                            <br>
                            <div class="col-sm-8" id="image-preview">
                                <div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
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
                        
                        <div class="row">
                             <div class="col-sm-8 col-sm-offset-2 alert" role="alert" id="alert-message"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
}