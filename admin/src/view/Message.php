<?php
/**
 * Created by PhpStorm.
 * User: handaoui
 * Date: 10/02/2018
 * Time: 09:01
 */

namespace admin\src\view;


class Message
{
    public static function showMessage($msg)
    {
        echo '
        <div style="padding:20px">
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
                            <label class="col-sm-2 control-label">Numéro téléphone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" value="' . $msg['phone'] . '" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-8">
                                <textarea disabled value="' . $msg['body'] . '" cols="50" rows="10" style="height: inherit;" class="form-control1"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }

    public static function showMessagesList($messages = [])
    {

    }
}