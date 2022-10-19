<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class VendorController extends MNPController
{

    public function init(){
        $this->title = 'Vendors';
        $this->table = 'vendors';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Vendor Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Vendor Name', 'col' => 'name', 'required' => true];
    }
    // public function getIndex(){
    //     return view('master.vendor.main', ['title' => 'Vendors']);
    // }

    // public function getAddVendors(){
    //     return view('master.vendor.form', ['title' => 'Vendors']);
    // }

    // public function saveVendors(){
    //     $name = Request::get('name');
    //     $company_id = Auth::user()->company_id;
    //     $now = date('Y-m-d H:i:s');
    //     $exist = DB::table('vendor')->where('company_id', $company_id)->where('code', $code)->first();
    //     if($exist){
    //         return 'error';
    //     }
    //     else{
    //         DB::table('vendor')->insert([
    //             'created_at' => $now,
    //             'name' => $name,
    //             'company_id' => $company_id,
    //         ]);
    //         return 'success';
    //     }
    // }
}
