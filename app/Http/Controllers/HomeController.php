<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;

use Illuminate\Http\Request;

class HomeController extends MNPController
{
    public function init(){
        $this->title = 'Dashboard';
    }

    public function getIndex(){
        return view('home', ['title' => 'Dashboard']);
    }
}
