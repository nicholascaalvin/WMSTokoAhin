<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getIndex(Request $request){
        return view('authentication.login', [
            'title' => 'Login',
        ]);
    }

    public function getData(Request $request){
        dd($request->email);
    }
}
