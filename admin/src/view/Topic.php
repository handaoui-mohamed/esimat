<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 08/02/2018
 * Time: 18:27
 */

namespace admin\src\view;

use app\Glob;

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
                            <div class="col-sm-4">
                                <label for="im_0">Image (Principale)</label>
                                <input accept="image/*" type="file" id="im_0" name="im_0">
                            </div>
                            <div class="col-sm-4">
                                <label for="ims">Images (Secondaires)</label>
                                <input accept="image/*" type="file" id="ims" name="ims[]" multiple>
                            </div>
                            <br>
                            <div class="col-sm-8 col-sm-offset-2" id="image-preview">
                                <div class="col-sm-6"></div>
                                <div></div>
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

    public static function showTopics($topics=[]){
        echo '
        <div style="padding:20px">
            <h3 class="blank1">Liste des articles</h3>
            <div class="xs tabls">
                <div class="bs-example4" data-example-id="contextual-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Contenu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>'.self::getTopicsRows($topics).'</tbody>
                    </table>
                </div>
            </div>
        ';
    }

    private static function getTopicsRows($topics){
        $content = '';
        $type = array('0'=>'Scientifique', '1'=>'Echequienne');
        for($i=0;$i<count($topics);$i++){
            $topic = $topics[$i];
            $topicBodyPreview = substr($topic['body'], 0, 70);
            $topicBodyPreview .= strlen($topic['body']) > 70 ? " ..." : ".";
            $content .= '
            <tr class="'.($i%2==0 ? 'active':'').'" id="topic-'.$topic['id'].'">
                <th scope="row">'.$topic['id'].'</th>
                <td>'.$topic['date_post'].'</td>
                <td>'.$topic['title'].'</td>
                <td>'.$type[$topic['type']].'</td>
                <td>'.$topicBodyPreview.'</td>
                <td>
                    <a href="'.Glob::DOMAIN_ADMIN.'update/topic/'.$topic['id'].'">
                        <i class="fa fa-pencil action-icon edit-action" ></i>
                    </a>
                    <a id="delete-'.$topic['id'].'">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm('.$topic['id'].')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>
            ';
        }
        return $content;
    }
}