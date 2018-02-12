<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 09/02/2018
 * Time: 11:41
 */

namespace admin\src\controller;


class Image
{
    public $error=false;
    public $codeError="";
    public $width_resize;
    public $height_resize;
    public $resizeMinQuality;
    public $type;
    public static $path="../images/articles/";


    public  static function setpath($path)
    {
        self::$path=$path;
    }
    function __construct()
    {
        $this->width_resize=310;
        $this->height_resize=250;
        $this->resizeMinQuality=80;

    }



    private function getNameImage()
    {
        $time=time();
        $image_link=sha1($time."_@#".rand(200,15555555)).(string)rand(1000000,90000000).sha1(rand(1000000,90000000)."kikimç*/".$time).(string)rand(1000000,90000000)."_".(string)rand(10,90000000);
        return $image_link;
    }

    private function getNameImageMin()//jpg toujour
    {
        $time=time();
        $image_link=sha1($time."e_".rand(20000,15555555)).(string)rand(1000000,90000000)."_".sha1($time."ç*)=ç".rand(5555,22222222222)).rand(100000,22222222)."_".(string)rand(10,90000000);
        return $image_link;
    }



    private function writeText($src,$dest,$text) //jpg toujour
    {
        list($width, $height, $source_image_type)= getimagesize($src);

        $font_size=(int)($width*0.009999999+$height*0.00999999);

        if ($font_size<6)
        {
            $font_size=6;
        }

        $offset_x = 0;

        $offset_y = 2*$font_size;

        $font_path = '../static/fonts/OpenSans-ExtraBold.ttf';

        $jpg_image = imagecreatefromjpeg($src);

        $white    = imagecolorallocate($jpg_image, 255, 255, 255);


        $bg_color = imagecolorallocatealpha($jpg_image, 0,0,0, 30);

        // Get the size of the text area
        $dims = imagettfbbox($font_size, 0, $font_path, $text);

        $text_width = $dims[4] - $dims[6] + $offset_x +24;

        $text_height = $dims[3] - $dims[5] + $offset_y;



        // Set Path to Font File


        // Print background On Image
        imagefilledrectangle($jpg_image,  ($width-$text_width-12)/2-24, 0,$text_width+($width-$text_width)/2, $text_height, $bg_color);
        // Print Text On Image
        imagettftext($jpg_image, $font_size, 0, ($width-$text_width)/2, $offset_y, $white, $font_path, $text);

        // Send Image to Browser
        imagejpeg($jpg_image,$dest.".jpg");

        // Clear Memory
        imagedestroy($jpg_image);
    }



    private function compress_image($src_file, $dest , $quality)  /**/
    {
        $info = @getimagesize($src_file);

        if ($info['mime'] == 'image/jpeg')
        {
            $image = imagecreatefromjpeg($src_file);

        }
        elseif ($info['mime'] == 'image/gif')
        {

            $image = imagecreatefromgif($src_file);

        }
        elseif ($info['mime'] == 'image/png')
        {
            $image = imagecreatefrompng($src_file);
        }
        else
        {
            return false;
        }

        imagejpeg($image, $dest.".jpg", $quality);

        return true;
    }




    private function resize_image($source_image_path, $dest,$width,$height,$quality,$resize) // return jpeg
    {
        $error=false;
        list($source_image_width, $source_image_height, $source_image_type) = @getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }

        $x=0;
        $y=0;
        if ($resize)
        {
            $source_aspect_ratio = $source_image_width / $source_image_height;
            $thumbnail_aspect_ratio = $width / $height;
            if ($source_image_width <= $width && $source_image_height <= $height) {
                $thumbnail_image_width = $source_image_width;
                $thumbnail_image_height = $source_image_height;
            } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
                $thumbnail_image_width = (int) ($height * $source_aspect_ratio);
                $thumbnail_image_height = $height;
            } else {
                $thumbnail_image_width = $width;
                $thumbnail_image_height = (int) ($width / $source_aspect_ratio);
            }
        }
        else
        {
            if ($width<=$source_image_width&&$height<=$source_image_height)
            {
                if ($source_image_width > $source_image_height )
                {
                    $y = 0;
                    $x = ($source_image_width - $source_image_height) / 2;
                    $source_image_width = $source_image_height;
                }
                else
                {
                    $x = 0;
                    $y = ($source_image_height - $source_image_width) / 2;
                    $source_image_height = $source_image_width;
                }
                $thumbnail_image_width=$width;
                $thumbnail_image_height=$height;
            }
            else
            {
                echo "La  doit etre > a (hauteur/largeur)".$width."/".$height;
                unlink($source_image_path);
                exit;
                return false;
            }

        }
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, $x, $y, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image,$dest.".jpg",$quality);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        return true;
    }

    /**********PUBLIC**************/

    public function saveImage($src,$ext)
    {
        $image_name=$this->getNameImage();

        $image_min_name=$this->getNameImageMin();

        $isGif =($ext==="gif");

        $qualityCompression=90;


        if (is_file($src))
        {
            if (!$isGif)
            {

                $filesize=@filesize($src);


                if ($filesize>40*1024||$ext=="png") //copresse pour >40 ko
                {
                    list($width, $height, $source_image_type) =@getimagesize($src);

                    if ($width>800 || $height>600)
                    {
                        // resize avec compression de 90
                        $this->resize_image($src,self::$path.$image_name,800,600,$qualityCompression,true);
                    }
                    else
                    {
                        // compresion de 90 seulement
                        $this->compress_image($src,self::$path.$image_name,$qualityCompression);
                    }
                    // unlink($src);
                    $link=self::$path.$image_name.".jpg";
                }
                else
                {
                    $link=$src;
                }

                $this->writeText($link,self::$path.$image_name,"esi-mat.com");
                $this->resize_image(self::$path.$image_name.".jpg",self::$path."min/".$image_min_name,$this->width_resize,$this->height_resize,$this->resizeMinQuality,$this->type=="J");
                $finalExt="jpg";
            }
            else
            {
                move_uploaded_file($src,self::$path.$image_name.".gif");
                $this->compress_image(self::$path.$image_name.".gif",self::$path.$image_name,$qualityCompression);
                $this->writeText(self::$path.$image_name.".jpg",self::$path.$image_name,"fb.com/DevWebAndProg");
                $this->resize_image(self::$path.$image_name.".jpg",self::$path."min/".$image_min_name,$this->width_resize,$this->height_resize,$this->resizeMinQuality,$this->type=="J");
                unlink(self::$path.$image_name.".jpg");
                $finalExt="gif";
            }

            return array('img' =>$image_name.".".$finalExt ,"imgmin"=>$image_min_name.".jpg");
        }
        return false;
    }

}
