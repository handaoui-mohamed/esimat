<?php
/**
 * Created by PhpStorm.
 * User: magic
 * Date: 28/12/2017
 * Time: 13:10
 */

namespace app\controller;


class Logic
{

private static $nbPagePagine=11;//impaire de pref

public static function getInfosPagine ($curpage,$totalPage)
{
   $center=(int)(self::$nbPagePagine/2);
   $info=array();
   $info['start']=1;
   $info['end']=$totalPage;


   if ($curpage>$center)
   {
       $info['start']=$curpage-$center;//11
   }

   if ($center+$curpage<=$totalPage)
   {
        $info['end']=$info['start']+self::$nbPagePagine-1;
   }
    if ($info['end']>$totalPage)
        $info['end']=$totalPage;

    if ($info['end']==$totalPage&&$totalPage>self::$nbPagePagine)
    {
        $info['start']=$info['end']-self::$nbPagePagine+1;
    }
    if ($info['end']<self::$nbPagePagine)
    {
        $info['start']=1;
    }

return $info;
}

}