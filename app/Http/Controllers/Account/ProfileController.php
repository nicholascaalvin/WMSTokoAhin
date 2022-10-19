<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\MNPController;

class ProfileController extends MNPController
{
    public function init(){
        $this->title = 'Profile';
        $this->table = 'users';
    }

    
    public function getIndex(){

        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        return view('account.profile', ['title' => 'Profile']);
    }
    /*
    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }
    */
}
