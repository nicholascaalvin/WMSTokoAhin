<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class ItemController extends MNPController
{
    public function init()
    {
        $this->title = 'Item List';
        $this->table = 'items';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'display' => 'none'];
        $this->main[] = ['label' => 'Item Name', 'col' => 'name'];
        $this->main[] = ['label' => 'Incoming', 'col' => 'incoming'];
        $this->main[] = ['label' => 'Outgoing', 'col' => 'outgoing'];
        $this->main[] = ['label' => 'Stock', 'col' => 'stock'];

        $this->forms[] = ['label' => 'Item Name', 'col' => 'name'];
        $this->forms[] = ['label' => 'Item Brand', 'col' => 'brand_id', 'select2' => 'brands'];
        $this->forms[] = ['label' => 'Item UOM', 'col' => 'uom_id', 'select2' => 'uoms'];
        $this->forms[] = ['label' => 'Item Weight (gr)', 'col' => 'weight'];
        $this->forms[] = ['label' => 'Item Origin', 'col' => 'country_id', 'select2' => 'countries'];
        $this->forms[] = ['label' => 'Description', 'col' => 'description'];
    }

    /*
    public function getIndex(){
        $data = DB::table('items')->get();
        return view('master.item.main', [
            'title' => 'Items',
            'data' => $data,
        ]);
    }

    public function getAddItems(){
        return view('master.item.form', ['title' => 'Items']);
    }

    public function getDetailItems(){
        return view('master.item.detail', ['title' => 'Items']);
    }

    public function saveItems(){
        $code = Request::get('code');
        $name = Request::get('name');
        $uom = Request::get('uom');
        $brand = Request::get('brand');
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
            'brand_id' => $brand,
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

    public function editItems(){
        $id = Request::get('id');
        $code = Request::get('code');
        $name = Request::get('name');
        $uom = Request::get('uom');
        $weight = Request::get('weight');
        $country = Request::get('country');
        $desc = Request::get('desc');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        DB::table('items')->where('company_id', $company_id)->where('id', $id)->update([
            'updated_at' => $now,
            'code' => $code,
            'name' => $name,
            'uom_id' => $uom,
            'weight' => $weight,
            'country_id' => $country,
            'description' => $desc,
            'company_id' => $company_id,
        ]);
        return 'updated';
    }

    public function searchItems(){
        $search = Request::get('q');
        $company_id = Auth::user()->company_id;
        $data = DB::table('items')->where('company_id', $company_id)->whereRaw("name like '%$search%'")->get();
        return view('master.item.main', [
            'title' => 'Items',
            'data' => $data,
            'searched' => $search,
        ]);
    }
    */
}
