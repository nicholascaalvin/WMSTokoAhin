<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends MNPController
{
    public function init(){
        $this->title = 'Dashboard';
    }

    public function getIndex(){

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
