<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class BrandController extends Controller
{
    public function getIndex(){
        $data = DB::table('brands')->get();
        return view('master.brand.main', [
            'title' => 'Brands', 
            'data' => $data,
        ]);
    }

    public function getAddBrands(){
        return view('master.brand.form', ['title' => 'Brands']);
    }

    public function getDetailBrands(){
        return view('master.brand.detail', ['title' => 'Brands']);
    }

    public function saveBrands(){
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('brands')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('brands')->insert([
                'created_at' => $now,
                'name' => $name,
                'company_id' => $company_id,
            ]);
            return 'success';
        }
    }

    public function deleteBrands(){
        $id = Request::get('id');
        $company_id = Auth::user()->company_id;
        DB::table('brands')->where('company_id', $company_id)->where('id', $id)->delete();
    }

    public function editBrands(){
        $id = Request::get('id');
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('brands')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('brands')->where('company_id', $company_id)->where('id', $id)->update([
                'updated_at' => $now,
                'name' => $name,
            ]);
            return 'updated';
        }
    }

    public function searchBrand(){

    }

    // public function getAddItems(){
    //     return view('master.item.form', ['title' => 'Items']);
    // }
}