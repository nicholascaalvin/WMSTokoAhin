<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

date_default_timezone_set("Asia/Jakarta");

class ItemController extends MNPController
{
    public function init()
    {
        $this->title = 'Items';
        $this->table = 'items';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Item Name', 'col' => 'name'];
        $this->main[] = ['label' => 'Incoming', 'col' => 'incoming'];
        $this->main[] = ['label' => 'Outgoing', 'col' => 'outgoing'];
        $this->main[] = ['label' => 'Stock', 'col' => 'stock'];

        $this->forms[] = ['label' => 'Item Name', 'col' => 'name', 'required' => true];
        $this->forms[] = ['label' => 'Item Brand', 'col' => 'brand_id', 'select2' => 'brands'];
        $this->forms[] = ['label' => 'Item UOM', 'col' => 'uom_id', 'select2' => 'uoms', 'required' => true];
        $this->forms[] = ['label' => 'Item Weight (gr)', 'col' => 'weight', 'required' => true];
        $this->forms[] = ['label' => 'Item Origin', 'col' => 'country_id', 'select2' => 'countries', 'required' => true];
        $this->forms[] = ['label' => 'Description', 'col' => 'description', 'textarea' => true];
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $page = explode('/', $this->data['url']);
        $request = $request->all();
        $now = date('Y-m-d H:i:s');
        foreach ($this->forms as $key => $value) {
            foreach ($request as $index => $dt) {
                if($index == $value['col']){
                    $this->inputs[$value['col']] = $dt;
                }
            }
        }
        if($page[2] == 'edit'){
            $this->inputs['updated_at'] = $now;
            $id = $page[3];
            DB::table($this->table)->where('id', $id)->where('company_id', Helper::getCompanyId())->update($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully edited the data');
        }
        else{
            $this->inputs['created_at'] = $now;
            $this->inputs['company_id'] = Helper::getCompanyId();
            $name = $this->inputs['name'];
            $exist = DB::table($this->table)->where('company_id', $this->inputs['company_id'])->where('name', $name)->get();
            // dd(count($exist) >= 1);
            if(count($exist) > 0){
                return redirect()->back()->with('error', 'Data existed!')->withInput();
            }
            else{
                DB::table($this->table)->insert($this->inputs);
                return redirect('/'.$this->table)->with('success', 'Successfully added new data');
            }
        }
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
