<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class AislesController extends Controller
{
    public function getIndex(){
        return view('master.aisle.main', ['title' => 'Aisles']);
    }

    public function getAddAisles(){
        return view('master.aisle.form', ['title' => 'Aisles']);
    }

    public function saveAisles(){
        $code = Request::get('code');
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        DB::table('aisles')->insert([
            'created_at' => $now,
            'code' => $code,
            'name' => $name,
            'company_id' => $company_id,
        ]);
        return redirect(url('aisles'));
    }
}
