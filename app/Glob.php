<?php

namespace app;
class Glob
{

    const DOMAIN = "http://localhost/ESIMAT/"; // nom de domaine

    const DOMAIN_ADMIN = "http://localhost/ESIMAT/admin/";

    /** information sur la base de données **/

    const DB_HOST = "localhost"; // nom de domaine bdd

    const DB_NAME = "esimat";   //

    const DB_UM = "root";  // nom utilisateur

    const DB_PW = ""; // mot de passe


    public static function getDate($str)
    {
        $moiS = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
        $time = strtotime($str);
        return preg_replace('#\##', $moiS[(int)date(' m', $time) - 1], date('\L\e d # Y', $time));
    }

}

?>