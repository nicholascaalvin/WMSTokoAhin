<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class UOMController extends MNPController
{
    public function init(){
        $this->title = 'Unit Of Measurements';
        $this->table = 'uoms';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'UOM Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'UOM Name', 'col' => 'name', 'required' => true];
    }

    public function getAddUOMs(){
        return view('master.uom.form', ['title' => 'Unit of Measurements']);
    }

    public function getDetailUOMs(){
        return view('master.uom.detail', ['title' => 'Unit of Measurements']);
    }

    public function saveUOMs(){
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('uom')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('uom')->insert([
                'created_at' => $now,
                'name' => $name,
                'company_id' => $company_id,
            ]);
            return 'success';
        }
    }

    public function editUOM(){
        $id = Request::get('id');
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        $exist = DB::table('uom')->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table('uom')->where('company_id', $company_id)->where('id', $id)->update([
                'updated_at' => $now,
                'name' => $name,
            ]);
            return 'updated';
        }
    }

    public function deleteUOM(){
        $id = Request::get('id');
        $company_id = Auth::user()->company_id;
        DB::table('uom')->where('company_id', $company_id)->where('id', $id)->delete();
    }

    public function searchUOM(){
        $search = Request::get('q');
        $company_id = Auth::user()->company_id;
        $data = DB::table('uom')->where('company_id', $company_id)->whereRaw("name like '%$search%'")->get();
        return view('master.uom.main', [
            'title' => 'Unit of Measurements',
            'data' => $data,
            'searched' => $search,
        ]);
    }
}
