<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function getIndex(Request $request){
        return view('authentication.register', [
            'title' => 'Register',
        ]);
    }

    public function storeData(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return back()->with('error', 'Please fill the form correctly')->withErrors($validator);
        }

        return redirect('/login')->with('success', 'Registration success!');
        // dd($request->name, $request->password);
        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'password' => $request->password,
        // ]);
    }
}
