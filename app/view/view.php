<?php

namespace app\view;

use app\Glob;

class View
{

    /**
     * @param $v
     */
    public static function header($v)
    {
        echo $v . "<br>" . Glob::DOMAIN . "...<br>";
    }

}

?>