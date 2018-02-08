<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 08/02/2018
 * Time: 18:27
 */

namespace admin\src\view;


class Topic
{
    public static function showTopicForm(){
        echo '
        <div style="padding:20px">
            <h3 class="blank1">Ajouter un nouveau article</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-topic-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="title" id="title" placeholder="Titre d\'article">
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
                            <label for="body" class="col-sm-2 control-label">Contenu</label>
                            <div class="col-sm-8">
                                <textarea name="body" id="body" cols="50" rows="10" style="height: inherit;" class="form-control1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Images</label>
                            <div class="col-sm-8">
                                <label for="im_0">Image 1 (Principale)</label>
                                <input accept="image/*" type="file" id="im_0" name="im_0">
                                <br>
                                <a style="color:#8BC34A;cursor: pointer" id="add-image-input">
                                    <i class="fa fa-plus"></i> Ajouter une autre image
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Videos</label>
                            <div class="col-sm-8">
                                <label for="vid_0">Video 1</label>
                                <input accept="video/*" type="file" id="vid_0" name="vid_0">
                                <br>
                                <a style="color:#8BC34A;cursor: pointer" id="add-video-input">
                                    <i class="fa fa-plus"></i> Ajouter une autre video
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn" type="submit">Confirmer</button>
                                <button class="btn-inverse btn" type="reset">Réinitialiser</button>
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