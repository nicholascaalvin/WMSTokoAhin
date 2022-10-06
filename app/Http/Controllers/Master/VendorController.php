<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class VendorController extends Controller
{
    public function getIndex(){
        return view('master.vendor.main', ['title' => 'Vendors']);
    }

    public function getAddVendors(){
        return view('master.vendor.form', ['title' => 'Vendors']);
    }

    public function saveVendors(){
        $name = Request::get('name');
        $company_id = Auth::user()->company_id;
        $now = date('Y-m-d H:i:s');
        $exist = DB::table('vendor')->where('company_id', $company_id)->where('code', $code)->first();
        if($exist){
            return 'error';
        }
        else{
            DB::table('vendor')->insert([
                'created_at' => $now,
                'name' => $name,
                'company_id' => $company_id,
            ]);
            return 'success';
        }
    }
}
