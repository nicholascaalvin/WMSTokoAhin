<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set("Asia/Jakarta");

class ItemController extends MNPController
{
    public function init()
    {
        $this->title = 'Items';
        $this->table = 'items';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Item Name', 'col' => 'name'];
        $this->main[] = ['label' => 'Incoming', 'col' => 'incoming'];
        $this->main[] = ['label' => 'Outgoing', 'col' => 'outgoing'];
        $this->main[] = ['label' => 'Stock', 'col' => 'stock', 'width' => '10%'];

        $this->forms[] = ['label' => 'Item Name', 'col' => 'name', 'required' => true];
        $this->forms[] = ['label' => 'Item Brand', 'col' => 'brand_id', 'type' => 'select2', 'select2_table' => 'brands'];
        $this->forms[] = ['label' => 'Item UOM', 'col' => 'uom_id', 'type' => 'select2', 'select2_table' => 'uoms', 'required' => true];
        $this->forms[] = ['label' => 'Item Life', 'col' => 'life', 'type' => 'life', 'required' => true];
        $this->forms[] = ['label' => 'Item Weight (gr)', 'col' => 'weight', 'type' => 'number', 'required' => true];
        $this->forms[] = ['label' => 'Item Origin', 'col' => 'country_id', 'type' => 'select2', 'select2_table' => 'countries', 'required' => true];
        $this->forms[] = ['label' => 'Description', 'col' => 'description', 'type' => 'textarea'];
        $this->forms[] = ['label' => 'Image', 'col' => 'image_name','type' => 'file'];

        $this->loadStock();
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $page = explode('/', $this->data['url']);
        $request1 = $request->all();

        //Storage::putFile('picture', $request['image_name']);
        //if($request['image_name'])
        //Storage::disk('public')->put('picture', $request['image_name']);
        //dd($request->all()->hasFile('name'));
        //dd($request->hasFile('image'));

        $input2 = $request->all();
        if($request->hasFile('image'))
        {
            $destination_path = 'public/picture';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            //dd($path);
            $input2['image'] = $image_name;
        }

        $now = date('Y-m-d H:i:s');
        foreach ($this->forms as $key => $value) {
            foreach ($request1 as $index => $dt) {
                if($index == $value['col']){
                    $this->inputs[$value['col']] = $dt;
                }
            }
        }
        $this->inputs['strlife'] = $request1['strlife'];
        $this->inputs['company_id'] = Helper::getCompanyId();

        $this->inputs['image_name'] = $input2['image'];
        
        if($page[2] == 'edit'){
            $this->inputs['updated_at'] = $now;
            $id = $page[3];
            DB::table($this->table)->where('id', $id)->where('company_id', $this->inputs['company_id'])->update($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully edited the data');
        }
        else{
            $this->inputs['created_at'] = $now;
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

    public function loadStock(){
        $data = DB::table($this->table)->where('company_id', Helper::getCompanyId())->get();
        foreach ($data as $key => $value) {
            $stock = $value->incoming - $value->outgoing;
            DB::table($this->table)->where('id', $value->id)->where('company_id', Helper::getCompanyId())->update([
                'stock' => $stock,
            ]);
        }
    }

}
