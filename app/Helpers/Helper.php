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
}

?>

