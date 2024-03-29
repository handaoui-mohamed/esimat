<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 09/02/2018
 * Time: 13:43
 */

namespace admin\src\controller;


class UploadData
{
    const MAX_SIZE_VIDEO=62914560;
    const MAX_SIZE_FILE=20971520;

    public static $errorsPost = array(
        "Titre non valide",
        "Catégorie d'article non valide",
        "Erreur d'upload des fichiers ,voulez réessayer",
        "On accepte que les images de type PNG et JPG",
        "Contenu d'article non valide",
        'On accepte que les images de type "mp4", "mov", "avi", "flv","mpg", "wmv", "3gp", "rm"',
        "Problème de compression de fichier",
        "La Taille max des vidéos est 60 Mo",
        "La Taille max du fichier est de 20 Mo",
        'La Taille max de tous les données est ',
        'La  > (hauteur/largeur)  doit etre > à 310px/250px',
    );

    // j'ai pas limité la taille pour les images


    private static  function isOverflowSize()
    {

        if (isset($_SERVER['CONTENT_LENGTH'])
            && (int) $_SERVER['CONTENT_LENGTH'] > 1024*1024*(int)(ini_get('post_max_size')))
        {
            $displayMaxSize = ini_get('post_max_size');

            switch ( substr($displayMaxSize,-1) )
            {
                case 'G':
                    $displayMaxSize = $displayMaxSize * 1024;
                case 'M':
                    $displayMaxSize = $displayMaxSize * 1024;
                case 'K':
                    $displayMaxSize = $displayMaxSize * 1024;
            }
         return true;
        }
        return false;
    }
    private static function saveVideoIfpossible($file)
    {

        $allowedExts = array("mp4", "mov", "avi", "flv", "mpg", "wmv", "3gp", "rm");

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (($file["type"] == "video/mp4") ||
            ($file["type"] == "video/mov") ||
            ($file["type"] == "video/avi") ||
            ($file["type"] == "video/flv") ||
            ($file["type"] == "video/mpg") ||
            ($file["type"] == "video/wmv") ||
            ($file["type"] == "video/3gp") ||
            ($file["type"] == "video/rm")) {
            if (in_array($extension, $allowedExts))
            {
                $video_link = sha1(time() . "_@!!!;#" . rand(200, 15555555)) . (string)rand(1000000, 90000000) . sha1('làl' . rand(100, 2000000000));
                move_uploaded_file($file["tmp_name"], "../videos/" . $video_link . '.' . $extension);
                return $video_link . '.' . $extension;
            } else
            {
                return 5;
            }
        }
        else
        {
            return 5;
        }
    }


    private static function saveToZip ($file)
    {
        $zip = new \ZipArchive();
        $name=time() .sha1(time() . "_@!ç(;#" . rand(200, 15555555)) . (string)rand(1000000, 90000000) . sha1('là5sdl' . rand(100, 2000000000)).".zip";
        $link='../downloads/'.$name;
        if ($zip->open($link, \ZIPARCHIVE::CREATE) != true)
        {
           return 6;
        }
        $zip->addFile($file['tmp_name'],$file['name']);
        $zip->close();
        return $name;
    }

    private static function saveImageIfpossible($file)
    {
        list($largeur, $hauteur, $type, $attr) = @getimagesize($file['tmp_name']);
        if (!empty($type) && !empty($attr) && !empty($hauteur) && !empty($largeur)) {

            $array_type_int_acc = array(2, 3);
            $ext = strtolower(pathinfo($file['name'])['extension']);
            $array_type = array('jpeg', 'jpg', 'png');
            if (in_array($type, $array_type_int_acc) && in_array($ext, $array_type)) {

                $i = new Image();
                $images=$i->saveImage($file['tmp_name'], $ext);

                if (!is_array($images))
                {
                    return array('error'=>true,'codeError'=>$images);
                }
                return $images;
            } else {
                return array('error'=>true,'code'=>3);
            }
        } else {
            return array('error'=>true,'code'=>3);
        }

    }

    public static function uploadTopic()
    {

            $result = array('videos' => '0');
            $addTopic = true;
            $codeError = -1;
            $size = 0;
            $nbVideo = 0;
        if (!self::isOverflowSize()) {
            while (!empty($_FILES['vid_' . $nbVideo]) && $codeError == -1) {
                $size += (int)$_FILES['vid_' . $nbVideo]['size'];
                if ($size > self::MAX_SIZE_VIDEO) {
                    $codeError = 7;
                }

                $nbVideo++;
            }

            if ($codeError == -1) {
                if (!empty($_POST['title'])) {
                    $result['title'] = htmlspecialchars($_POST['title']);
                    if (isset($_POST['type']) && ($_POST['type'] == 0 || $_POST['type'] == 1)) {
                        $result['type'] = $_POST['type'];
                        if (!empty($_POST['body'])) {
                            $result['body'] = htmlspecialchars($_POST['body']);
                            if (!empty($_FILES["im_0"])) {
                                /*Image principale controle **/
                                $result['img'] = 'default.jpg';
                                $result['imgmin'] = 'default.jpg';

                                if ($_FILES["im_0"]['error'] === 4) {
                                } else {
                                    if (is_uploaded_file($_FILES["im_0"]['tmp_name']) && $_FILES["im_0"]['error'] === 0) {

                                        $infoPrincipaleImage = self::saveImageIfpossible($_FILES["im_0"]);
                                        if (empty($infoPrincipaleImage['error'])) {
                                            $result['img'] = $infoPrincipaleImage['img'];
                                            $result['imgmin'] = $infoPrincipaleImage['imgmin'];
                                        } else {
                                            $codeError = $infoPrincipaleImage['codeError'];
                                            $addTopic = false;
                                        }

                                    } else {
                                        $codeError = 2;//erreur d'upload
                                        $addTopic = false;
                                    }

                                }
                            } else {
                                $result['img'] = 'default.jpg';
                                $result['imgmin'] = 'default.jpg';
                            }

                        } else // body !
                        {
                            $addTopic = false;
                            $codeError = 4;

                        }
                    } else // type d'article
                    {
                        $addTopic = false;
                        $codeError = 1;
                    }
                } else // titre vide
                {
                    $addTopic = false;
                    $codeError = 0;
                }

                if ($codeError == -1) {
                    $addTopic = true;
                    $temp = array('img' => [], 'imgmin' => []);
                    if (!empty($_FILES['ims'])) {
                        $nb_other_image = count($_FILES['ims']['name']);

                        if ($nb_other_image == 1 && empty($_FILES['ims']['name'][0])) {
                            // pas d'autre images
                        } else {
                            for ($i = 0; $i < $nb_other_image; $i++) {
                                if (!empty($_FILES["ims"]['tmp_name'][$i]) && is_uploaded_file($_FILES["ims"]['tmp_name'][$i]) && $_FILES["ims"]['error'][$i] === 0) {
                                    if (!empty($_FILES["ims"]['size'][$i]) && $_FILES["ims"]['size'][$i] != 0) {
                                        $ImageInfo = self::saveImageIfpossible(array('tmp_name' => $_FILES["ims"]['tmp_name'][$i], 'name' => $_FILES["ims"]['name'][$i]));
                                        if (!empty($ImageInfo['error'])) {
                                            // SUPRESSION ...
                                            $addTopic = false;
                                            $codeError = $ImageInfo['codeError'];
                                        } else {
                                            $temp['img'][] = $ImageInfo['img'];
                                            $temp['imgmin'][] = $ImageInfo['imgmin'];
                                            $result['img'] .= ";" . $ImageInfo['img'];
                                            $result['imgmin'] .= ";" . $ImageInfo['imgmin'];

                                        }
                                    } else {
                                        $addTopic = false;
                                        $codeError = 3;
                                    }
                                } else {
                                    $addTopic = false;
                                    $codeError = 3;
                                }

                            }
                        }
                    }

                }

                // partie video
                $videos = "";
                if ($codeError == -1) {

                    if (!empty($_FILES['vid_0']) && $_FILES['vid_0']['error'] !== 4) {
                        if ($_FILES['vid_0']['error'] === 0) {

                            if (!empty($_FILES["vid_0"]['tmp_name']) && is_uploaded_file($_FILES["vid_0"]['tmp_name'])) {
                                $i = 0;
                                $temp['video'] = [];
                                $videos = array();

                                while ($i < $nbVideo && $codeError == -1) {

                                    $videolink = self::saveVideoIfpossible($_FILES['vid_' . $i]);
                                    if ($videolink !== 5) {
                                        $temp['video'][] = $videolink;
                                        $videos[] = $videolink;

                                    } else {

                                        $codeError = 5;
                                    }
                                    $i++;
                                }
                                if ($codeError == -1) {
                                    $result['videos'] = implode(";", $videos);
                                }

                            } else {
                                $codeError = 2;
                            }

                        } else {
                            $codeError = 3;
                        }
                    }
                }
            }
        }else
        {
            $codeError=9;
            self::$errorsPost[9].=ini_get('post_max_size');
        }

        if ($codeError == -1) return array("addIt" => true, "data" => $result);
        else return array("addIt" => false, "data" => self::$errorsPost[$codeError]);
    }

    public static function uploadAlbum()
    {
        $result = array('title' => '', 'description' => '', 'img' => array(), 'imgmin' => array(), 'titles' => array());
        if (!self::isOverflowSize()) {
        if (isset($_POST['title']))
        {
            $result['title'] = htmlspecialchars($_POST['title']);
            if (isset($_POST['body']))
            {
                $result['description'] = htmlspecialchars($_POST['body']);
                $add = true;
            }
            else
            {
                $add = false;
            }
        }
        else
        {
            $add = false;
        }

        if (!empty($add)) {
            Image::setpath('../images/album/');
            if (!empty($_FILES['ims'])) {
                $nb_other_image = count($_FILES['ims']['name']);

                if ($nb_other_image == 1 && empty($_FILES['ims']['name'][0])) {
                    // pas d'autre images
                } else {
                    for ($i = 0; $i < $nb_other_image; $i++) {
                        if (!empty($_FILES["ims"]['tmp_name'][$i]) && is_uploaded_file($_FILES["ims"]['tmp_name'][$i]) && $_FILES["ims"]['error'][$i] === 0) {

                            if (!empty($_FILES["ims"]['size'][$i]) && $_FILES["ims"]['size'][$i] != 0) {

                                $ImageInfo = self::saveImageIfpossible(array('tmp_name' => $_FILES["ims"]['tmp_name'][$i], 'name' => $_FILES["ims"]['name'][$i]));
                                if (!empty($ImageInfo ['error'])) {
                                    // SUPRESSION ...
                                    $codeerror = $ImageInfo ['codeError'];
                                    $add = false;
                                }
                                else
                                    {
                                    $result['img'][] = $ImageInfo['img'];
                                    $result['imgmin'][] = $ImageInfo['imgmin'];
                                    if (empty($_POST['title_' . $i])) {
                                        $title = "";
                                    } else
                                    {
                                        $title = htmlspecialchars($_POST['title_' . $i]);
                                    }
                                    $result['titles'][] = $title;
                                }
                            } else
                            {
                                $add = false;

                            }
                        } else
                        {
                            $add = false;
                        }

                    }
                }
            }


        }
        }
        else
        {
         return  array('add' => false, 'data' => self::$errorsPost[9].ini_get('post_max_size'));
        }

        if (!empty($add)) {return array('add' => true, 'data' => $result);}
        else {
            if (isset($codeerror)) return array('add' => false, 'data' => self::$errorsPost[$codeerror]);
        }
        return array('add' => false, 'data' => self::$errorsPost[3]);
    }

    public static function uploadFile()
    {

            $codeerrors = -1;
            $link = "";
            $result = array("img" => "default.jpg");
        if (!self::isOverflowSize()) {
            if (isset($_POST['title'])) {
                $result['title'] = htmlspecialchars($_POST['title']);
                if (isset($_POST['type']) && ($_POST['type'] == 0 || $_POST['type'] == 1)) {
                    $result['type'] = $_POST['type'];
                    if (!empty($_FILES['file'])) {
                        if ($_FILES['file']['size'] < self::MAX_SIZE_FILE) {
                            if ($_FILES["file"]['error'] === 0 && is_uploaded_file($_FILES["file"]['tmp_name'])) {
                                $state = self::saveToZip($_FILES["file"]);
                                if ($state != 6) {
                                    $result['file'] = $state;
                                    if (!empty($_FILES['im'])) {
                                        if ($_FILES["im"]['error'] !== 4) {

                                            if ($_FILES["im"]['error'] === 0 && is_uploaded_file($_FILES["im"]['tmp_name'])) {
                                                Image::setpath('../downloads/images/');
                                                $result['img'] = self::saveImageIfpossible($_FILES["im"]);
                                                if (!empty($result['img']['error'])) {
                                                    $codeerrors = $result['img']['codeError'];
                                                } else {
                                                    if (!empty($result['img'] ))
                                                    {
                                                        unlink('../downloads/images/'.$result['img']['img']);
                                                    }
                                                    $result['img'] = $result['img']['imgmin'];
                                                }

                                            } else {
                                                $codeerrors = 2;
                                            }
                                        }

                                    }

                                } else {
                                    $codeerrors = 6;
                                }
                            } else {
                                $codeerrors = 2;
                            }
                        } else {
                            $codeerrors = 7;
                        }
                    } else {
                        $codeerrors = 2;
                    }
                } else {
                    $codeerrors = 1;
                }
            } else {
                $codeerrors = 0;
            }
        }
        else{
            $codeerrors=9;
            self::$errorsPost[9].=ini_get('post_max_size');
        }

        if (!empty($codeerrors == -1)) return array('add' => true, 'data' =>$result);
        else return array('add' => false, 'data' => self::$errorsPost[$codeerrors]);

    }


}