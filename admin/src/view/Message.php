<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 10/02/2018
 * Time: 09:01
 */

namespace admin\src\view;


use app\Glob;

class Message
{
    public static function showMessage($msg)
    {
        echo
        '<div style="padding:20px">
            <h3 class="blank1">Détail du message</h3>
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" id="message-form" onsubmit="return false">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" value="' . $msg['email'] . '" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nom complet</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" value="' . $msg['name'] . '" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-8">
                                <textarea disabled cols="50" rows="10" style="height: inherit;" class="form-control1">' . $msg['body'] . '</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }

    public static function showMessages($messages = [])
    {
        echo
        '<div style="padding:20px">
            <h3 class="blank1">Liste des message</h3>
            <div class="xs tabls">
                <div class="bs-example4" data-example-id="contextual-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Email</th>
                                <th>Nom Complet</th>
                                <th>Message</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>' . self::getMessagesRows($messages) . '</tbody>
                    </table>
                </div>
            </div>';
    }

    private static function getMessagesRows($messages)
    {
        $content = '';

        foreach ($messages as $message) {
            $messageBodyPreview = substr($message['body'], 0, 70);
            $messageBodyPreview .= strlen($message['body']) > 70 ? " ..." : ".";
            $content .=
            '<tr onclick="navigateTo(\''.Glob::DOMAIN_ADMIN.'message/'.$message['id'].'\')" class="clickabale-row ' . ($message['view'] ? 'active' : '') . '" id="message-' . $message['id'] . '">
                <th scope="row">' . $message['id'] . '</th>
                <td>' . $message['email'] . '</td>
                <td>' . $message['name'] . '</td>
                <td>' . $messageBodyPreview . '</td>
                <td>' . ($message['view'] ? '':'<div style="background-color: #3fa243;color: #fff;width: 70px;text-align: center">nouveau</div>' ) . '</td>
                <td>
                    <a id="delete-' . $message['id'] . '">
                        <i class="fa fa-trash action-icon delete-action"  onclick="showDeleteConfirm(' . $message['id'] . ')"></i>
                    </a>
                    <div class="confirmation-buttons"></div>
                </td>
            </tr>';
        }
        return $content;
    }
}