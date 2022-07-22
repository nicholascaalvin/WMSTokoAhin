<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getIndex(){
        return view('home', ['title' => 'Dashboard']);
    }
}
