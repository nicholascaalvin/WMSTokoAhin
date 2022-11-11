<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class VendorController extends MNPController
{

    public function init(){
        $this->title = 'Vendors';
        $this->table = 'vendors';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Vendor Code', 'col' => 'code'];
        $this->main[] = ['label' => 'Vendor Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Vendor Code', 'col' => 'code', 'readonly' => true];
        $this->forms[] = ['label' => 'Vendor Name', 'col' => 'name', 'required' => true];
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
                    $like = $index;
                    $col = $dt;
                }
            }
        }
        $this->inputs['company_id'] = Helper::getCompanyId();
        if($page[2] == 'edit'){
            $this->inputs['updated_at'] = $now;
            $id = $page[3];
            DB::table($this->table)->where('id', $id)->where('company_id', $this->inputs['company_id'])->update($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully edited the data');
        }
        else{
            $this->inputs['created_at'] = $now;
            $max = DB::table($this->table)->pluck('code');
            foreach ($max as $key => $value) {
                $max[$key] = substr($value, 1);
            }
            if(count($max) ==  0){
                $code = 'V1';
            }
            else{
                $idx = intval(max($max->toArray())) + 1;
                $code = 'V' . $idx;
            }
            $this->inputs['code'] = $code;

            $id = DB::table($this->table)->insertGetId($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully added new data');
        }
    }

}
