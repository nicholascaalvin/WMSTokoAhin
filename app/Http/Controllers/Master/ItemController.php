<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class ItemController extends Controller
{
    public function getIndex(){
        return view('master.item.main', ['title' => 'Items']);
    }

    public function getAddItems(){
        return view('master.item.form', ['title' => 'Items']);
    }

    public function saveItems(){
        $code = Request::get('code');
        $name = Request::get('name');
        $uom = Request::get('uom');
        $weight = Request::get('weight');
        $country = Request::get('country');
        $desc = Request::get('desc');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;

        // dd($code, $name, $uom, $weight, $country, $desc, $now, $company_id);
        DB::table('items')->insert([
            'created_at' => $now,
            'code' => $code,
            'name' => $name,
            'uom_id' => $uom,
            'weight' => $weight,
            'country_id' => $country,
            'description' => $desc,
            'incoming' => 0,
            'outgoing' => 0,
            'stock' => 0,
            'company_id' => $company_id,
        ]);
        return 'success';
    }
}
