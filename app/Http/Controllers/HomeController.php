<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends MNPController
{
    public function init(){
        $this->title = 'Dashboard';
    }

    public function getIndex(Request $request){

        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        return view('home', ['title' => 'Dashboard']);
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

}
