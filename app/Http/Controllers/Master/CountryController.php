<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class CountryController extends Controller
{
    public function getIndex(){
        $data = DB::table('countries')->get();
        return view('master.country.main', [
            'title' => 'Countries',
            'data' => $data,
        ]);
    }

    public function getAddCountries(){
        return view('master.country.form', ['title' => 'Countries']);
    }

    public function getDetailCountries(){
        return view('master.country.detail', ['title' => 'Countries']);
    }

    public function saveCountries(){
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('countries')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('countries')->insert([
                'created_at' => $now,
                'name' => $name,
                'company_id' => $company_id,
            ]);
            return 'success';
        }
    }

    public function editCountry(){
        $id = Request::get('id');
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('countries')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('countries')->where('company_id', $company_id)->where('id', $id)->update([
                'updated_at' => $now,
                'name' => $name,
            ]);
            return 'updated';
        }
    }

    public function deleteCountries(){
        $id = Request::get('id');
        $company_id = Auth::user()->company_id;
        DB::table('countries')->where('company_id', $company_id)->where('id', $id)->delete();
    }

    public function searchCountries(Request $request){
        $search = Request::get('q');
        $company_id = Auth::user()->company_id;
        $data = DB::table('countries')->where('company_id', $company_id)->whereRaw("name like '%$search%'")->get();
        return view('master.country.main', [
            'title' => 'Countries',
            'data' => $data,
            'searched' => $search,
        ]);
    }
}
