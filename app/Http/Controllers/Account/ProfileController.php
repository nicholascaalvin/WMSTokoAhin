<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\MNPController;
use App\Helpers\Helper;

class ProfileController extends MNPController
{
    public function init(){
        $this->title = 'Profile';
        $this->table = 'users';

        $this->forms[] = ['label' => 'Name', 'col' => 'name'];
        $this->forms[] = ['label' => 'Email', 'col' => 'email'];
        $this->forms[] = ['label' => 'Password', 'col' => 'email'];
        $this->forms[] = ['label' => 'Password', 'col' => 'email'];

    }

    public function getIndex(){
        $this->load();
        
        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        $this->data['page'] = 'details';

        
        return view('template.form', $this->data);
    }

    /*
    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }
    */
}
