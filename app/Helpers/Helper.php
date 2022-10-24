<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper{

    public static function getCompanyId(){
        $myCompany = Auth::user()->company_id;
        return $myCompany;
    }

    public static function getName(){
        $myName = Auth::user()->name;
        return $myName;
    }

    public static function getFullUrl(){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $url;
    }

    public static function getCurrentUrl(){
        $url = $_SERVER['REQUEST_URI'];
        return $url;
    }

    public static function getMainUrl($url = null){
        $url = "http://$_SERVER[HTTP_HOST]".$url;
        return $url;
    }
}

?>

