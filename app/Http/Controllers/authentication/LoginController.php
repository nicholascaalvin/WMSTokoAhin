<?php

namespace App\Http\Controllers\authentication;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class LoginController extends Controller
{
    public function getIndex(Request $request){
        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('authentication.login', ['title' => 'Login']);
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function getData(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->with('error', 'Failed!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
