<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class AislesController extends MNPController
{
    public function init(){
        $this->title = 'Aisles';
        $this->table = 'aisles';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Aisle Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Aisle Name', 'col' => 'name', 'required' => true];
    }

    // public function getIndex(){
    //     $data = DB::table('aisle')->get();
    //     return view('master.aisle.main', [
    //         'title' => 'Aisles',
    //         'data' => $data,
    //     ]);
    // }

    // public function getAddAisles(){
    //     return view('master.aisle.form', ['title' => 'Aisles']);
    // }

    // public function getDetailAisles(){
    //     return view('master.aisle.detail', ['title' => 'Aisles']);
    // }

    // public function saveAisles(){
    //     $code = Request::get('code');
    //     $name = Request::get('name');
    //     $now = date('Y-m-d H:i:s');
    //     $company_id = Auth::user()->company_id;
    //     $exist = DB::table('aisle')->where('company_id', $company_id)->where('code', $code)->first();
    //     if($exist){
    //         return 'error';
    //     }
    //     else{
    //         DB::table('aisle')->insert([
    //             'created_at' => $now,
    //             'code' => $code,
    //             'name' => $name,
    //             'company_id' => $company_id,
    //         ]);
    //         return 'success';
    //     }
    // }

    // public function editAisles(){
    //     $id = Request::get('id');
    //     $code = Request::get('code');
    //     $name = Request::get('name');
    //     $now = date('Y-m-d H:i:s');
    //     $company_id = Auth::user()->company_id;
    //     $exist = DB::table('aisle')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
    //     if ($exist) {
    //         return 'error';
    //     }
    //     else{
    //         DB::table('aisle')->where('company_id', $company_id)->where('id', $id)->update([
    //             'updated_at' => $now,
    //             'code' => $code,
    //             'name' => $name,
    //         ]);
    //         return 'updated';
    //     }
    // }

    // public function deleteAisles(){
    //     $id = Request::get('id');
    //     $company_id = Auth::user()->company_id;
    //     DB::table('aisle')->where('company_id', $company_id)->where('id', $id)->delete();
    // }

    // public function searchAisles(){
    //     $search = Request::get('q');
    //     $company_id = Auth::user()->company_id;
    //     $data = DB::table('aisle')->where('company_id', $company_id)->whereRaw("name like '%$search%'")->get();
    //     return view('master.aisle.main', [
    //         'title' => 'Aisles',
    //         'data' => $data,
    //         'searched' => $search,
    //     ]);
    // }
}
