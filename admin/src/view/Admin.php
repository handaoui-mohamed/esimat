<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 10/02/2018
 * Time: 13:20
 */

namespace admin\src\view;
use app\Glob;


class Admin
{
    public static function showAdminForm($admin = array())
    {
        $isNew = empty($admin);
        if ($isNew) {
            $admin = array(
                'email' => '',
                'name' => '',
                'role' => 'sc',
            );
        }
        echo
        '<div style="padding:20px">
            <h3 class="blank1">' . ($isNew ? 'Ajouter un nouveau administrateur' : 'Modifier les informations du administrateur') . '</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="new-admin-form" onsubmit="return false">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nom Complet</label>
                            <div class="col-sm-8">
                                <input value="' . $admin['name'] . '" type="text" class="form-control1" name="name" id="name" placeholder="Nom et Prénom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input value="' . $admin['email'] . '" type="text" class="form-control1" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-2 control-label">Catégorie (rôle)</label>
                            <div class="col-sm-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="sc" name="role" ' . ($admin['role'] == 'sc' ? 'checked' : '') . '> Scientifique</label>
                                </div>
                                <div class="radio-inline">
                                        <label><input type="radio" value="ec" name="role" ' . ($admin['role'] == 'ec' ? 'checked' : '') . '> Echequienne</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pw" class="col-sm-2 control-label">Mot de passe</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control1" name="pw" id="pw" placeholder="Mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cpw" class="col-sm-2 control-label">Confirmer le mot de passe</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control1" name="cpw" id="cpw" placeholder="Confirmation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn" type="submit">Confirmer</button>
                                <button class="btn-inverse btn" type="reset" id="form-reset">Réinitialiser</button>
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

    public static function showAdmins($admins = [])
    {
        echo '
        <div style="padding:20px">
            <h3 class="blank1">Liste des articles (' . count($admins) . ')</h3>
            <div class="xs tabls">
                <div class="bs-example4" data-example-id="contextual-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom Complet</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>' . self::getAdminsRows($admins) . '</tbody>
                    </table>
                </div>
            </div>
        ';
    }

    private static function getAdminsRows($admins)
    {
        $content = '';
        $role = array('sc' => 'Scientifique', 'ec' => 'Echequienne');

        foreach ($admins as $admin) {
            $content .= '
            <tr id="admin-' . $admin['id'] . '">
                <th scope="row">' . $admin['id'] . '</th>
                <td>' . $admin['name'] . '</td>
                <td>' . $admin['email'] . '</td>
                <td>' . $role[$admin['role']] . '</td>
                <td>
                    <a href="' . Glob::DOMAIN_ADMIN . 'update/admin/' . $admin['id'] . '">
                        <i class="fa fa-pencil action-icon edit-action" ></i>
                    </a>
                    <a id="delete-' . $admin['id'] . '">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' . $admin['id'] . ')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>
            ';
        }
        return $content;
    }
}