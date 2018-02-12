<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 09/02/2018
 * Time: 14:23
 */

namespace admin\src\view;

use app\Glob;

class Album
{
    private static function getImagesPreview($images)
    {
        $content = '';
        $nbImages = count($images);
        for ($i = 0; $i < $nbImages; $i++) {
            $image = $images[$i];
            $content .= '<div class="col-sm-2"><img id="image-preview"  style="height:100px; width:100%;"  src="' . $image['src'] . '" >';
            $content .= '<input value="' . $image['title'] . '" class="image-preview-title" name="title_' . $i . '" type="text" placeholder="Titre"/></div>';
        }
        return $content;
    }

    public static function showAlbumForm($album = array())
    {
        $isNew = empty($album);
        if ($isNew) {
            $album = array(
                'title' => '',
                'body' => '',
                'images' => [],
            );
        }
        echo
        '<div style="padding:20px">
            <h3 class="blank1">'.($isNew ? 'Ajouter un nouveau album' : 'Modifier l\'album').'</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-album-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input value="' . $album['title'] . '" type="text" class="form-control1" name="title" id="title" placeholder="Titre d\'album">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea value="' . $album['body'] . '" name="body" id="body" cols="50" rows="10" style="height: inherit;" class="form-control1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">Images</label>
                            <div class="col-sm-4">
                                <input accept="image/*" type="file" id="ims" name="ims[]" multiple>
                            </div>
                            <br>
                            <div class="col-sm-8" id="image-preview">
                                <div>' . self::getImagesPreview($album['images']) . '</div>
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

    public static function showAlbums($albums = [])
    {
        echo
        '<div style="padding:20px">
            <h3 class="blank1">Liste des album</h3>
            <div class="xs tabls">
                <div class="bs-example4" data-example-id="contextual-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>' . self::getAlbumsRows($albums) . '</tbody>
                    </table>
                </div>
            </div>';
    }

    private static function getAlbumsRows($albums)
    {
        $content = '';
        $nbAlbums = count($albums);

        for ($i = 0; $i < $nbAlbums; $i++) {
            $album = $albums[$i];
            $content .=
            '<tr  onclick="navigateTo(\''.Glob::DOMAIN_ADMIN.'album/'.$album['id'].'\')" class="clickabale-row ' . ($i % 2 == 0 ? 'active' : '') . '" id="album-' . $album['id'] . '">
                <th scope="row">' . $album['id'] . '</th>
                <td>' . $album['date_post'] . '</td>
                <td>' . $album['title'] . '</td>
                <td>' . $album['description'] . '</td>
                <td>
                    <a id="edit-' . $album['id'] . '" href="' . Glob::DOMAIN_ADMIN . 'update/album/' . $album['id'] . '">
                        <i class="fa fa-pencil action-icon edit-action" ></i>
                    </a>
                    <a id="delete-' . $album['id'] . '">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' . $album['id'] . ')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>';
        }
        return $content;
    }
}