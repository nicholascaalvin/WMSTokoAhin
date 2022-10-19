<?php

namespace App\Http\Controllers\authentication;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function getIndex(){
        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('authentication.register', ['title' => 'Register']);
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function storeData(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return back()->with('error', 'Please fill the form correctly')->withErrors($validator);
        }

        // create new customer
        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);

        $new_user->save();

        return redirect('/login')->with('success', 'Registration success!');
    }
}
