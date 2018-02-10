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
    public static function showFileForm($file = array())
    {
        $isNew = empty($file);
        if ($isNew) {
            $file = array(
                'title' => '',
                'type' => 0
            );
        }
        echo '
        <div style="padding:20px">
            <h3 class="blank1">'.($isNew ? 'Ajouter un nouveau fichier' : 'Modifier le fichier').'</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" enctype="multipart/form-data" id="new-file-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Titre</label>
                            <div class="col-sm-8">
                                <input value="' . $file['title'] . '" type="text" class="form-control1" name="title" id="title" placeholder="Titre du fichier">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-2 control-label">Catégorie</label>
                            <div class="col-sm-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="0" name="type" ' . ($file['type'] ? '' : 'checked') . '> Scientifique</label>
                                </div>
                                <div class="radio-inline">
                                        <label><input type="radio" value="1" name="type" ' . ($file['type'] ? 'checked' : '') . '> Echequienne</label>
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
                                <input accept="application/zip" type="file" id="file" name="file">
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
                        
                        <div class="row">
                             <div class="col-sm-8 col-sm-offset-2 alert" role="alert" id="alert-message"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }

    public static function showFiles($files = [])
    {
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
                                <th>Fichier</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>' . self::getFilesRows($files) . '</tbody>
                    </table>
                </div>
            </div>
        ';
    }

    private static function getFilesRows($files)
    {
        $content = '';
        $type = array('0' => 'Scientifique', '1' => 'Echequienne');
        $nbFiles = count($files);

        for ($i = 0; $i < $nbFiles; $i++) {
            $file = $files[$i];
            $content .= '
            <tr class="' . ($i % 2 == 0 ? 'active' : '') . '" id="file-' . $file['id'] . '">
                <th scope="row">' . $file['id'] . '</th>
                <td>' . $file['date_post'] . '</td>
                <td>' . $file['title'] . '</td>
                <td>' . $type[$file['type']] . '</td>
                <td>' . $file['source'] . '</td>
                <td>
                    <a href="' . Glob::DOMAIN_ADMIN . 'update/file/' . $file['id'] . '">
                        <i class="fa fa-pencil action-icon edit-action" ></i>
                    </a>
                    <a id="delete-' . $file['id'] . '">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' . $file['id'] . ')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>
            ';
        }
        return $content;
    }
}