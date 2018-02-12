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
    private static function getImagesPreview($imagesString)
    {
        $images = explode(';',$imagesString);
        $nbImages = count($images);
        $content = '<div class="col-sm-6"></div><div></div>';
        if($nbImages > 0 && !empty($images[0])){
            $content =
           '<div class="col-sm-6">
                <img id="image-preview"  style="height:205px; width:100%;"  src="'.$images[0].'" >
            </div><div>';
            for ($i = 1; $i < $nbImages; $i++) {
                $content .= '<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="'.$images[$i].'" ></div>';
            }
            $content .= '</div>';
        }
        return $content;
    }

    public static function showTopicForm($topic = array())
    {
        $isNew = empty($topic);
        if ($isNew) {
            $topic = array(
                'title' => '',
                'body' => '',
                'type' => 0,
                'images' => '',
                'videos' => '',
            );
        }
        echo
        '<div style="padding:20px">
            <h3 class="blank1">'.($isNew ? 'Ajouter un nouveau article' : 'Modifier l\'article').'</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-topic-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input value="' . $topic['title'] . '" type="text" class="form-control1" name="title" id="title" placeholder="Titre d\'article">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-2 control-label">Catégorie</label>
                            <div class="col-sm-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="0" name="type" ' . ($topic['type'] ? '' : 'checked') . '> Scientifique</label>
                                </div>
                                <div class="radio-inline">
                                        <label><input type="radio" value="1" name="type" ' . ($topic['type'] ? 'checked' : '') . '> Echequienne</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Contenu</label>
                            <div class="col-sm-8">
                                <textarea value="' . $topic['body'] . '" name="body" id="body" cols="50" rows="10" style="height: inherit;" class="form-control1"></textarea>
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
                            <div class="col-sm-8 col-sm-offset-2" id="image-preview">'.self::getImagesPreview($topic['images']).'</div>
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
                        
                        <div class="row">
                             <div class="col-sm-8 col-sm-offset-2 alert" role="alert" id="alert-message"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }

    public static function showTopics($topics = [])
    {
        echo
        '<div style="padding:20px">
            <h3 class="blank1">Liste des articles ('.count($topics).')</h3>
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
                        <tbody>' . self::getTopicsRows($topics) . '</tbody>
                    </table>
                </div>
            </div>';
    }

    private static function getTopicsRows($topics)
    {
        $content = '';
        $type = array('0' => 'Scientifique', '1' => 'Echequienne');
        $nbTopics = count($topics);

        for ($i = 0; $i < $nbTopics; $i++) {
            $topic = $topics[$i];
            $topicBodyPreview = substr($topic['body'], 0, 70);
            $topicBodyPreview .= strlen($topic['body']) > 70 ? " ..." : ".";
            $content .=
            '<tr onclick="navigateTo(\''.Glob::DOMAIN_ADMIN.'topic/'.$topic['id'].'\')" class="clickabale-row ' . ($i % 2 == 0 ? 'active' : '') . '" id="topic-' . $topic['id'] . '">
                <th scope="row">' . $topic['id'] . '</th>
                <td>' .Glob::getDate($topic['date_post']). '</td>
                <td>' . $topic['title'] . '</td>
                <td>' . $type[$topic['type']] . '</td>
                <td>' . $topicBodyPreview . '</td>
                <td>
                    <a id="edit-' . $topic['id'] . '" href="' . Glob::DOMAIN_ADMIN . 'update/topic/' . $topic['id'] . '">
                        <i class="fa fa-pencil action-icon edit-action" ></i>
                    </a>
                    <a id="delete-' . $topic['id'] . '">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' . $topic['id'] . ')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>';
        }
        return $content;
    }
}