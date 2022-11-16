<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class CustomerController extends MNPController
{
    public function init(){
        $this->title = 'Customer';
        $this->table = 'customers';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Customer Code', 'col' => 'code'];
        $this->main[] = ['label' => 'Customer Name', 'col' => 'name'];
        $this->main[] = ['label' => 'Customer Address', 'col' => 'address'];

        $this->forms[] = ['label' => 'Customer Code', 'col' => 'code', 'readonly' => true];
        $this->forms[] = ['label' => 'Customer Name', 'col' => 'name', 'required' => true];
        $this->forms[] = ['label' => 'Customer Address', 'col' => 'address', 'required' => true];

        $this->js = "
        $(document).ready(function(){
            var url = window.location.href;
            url = url.split('/');
            if(url.length == 5){
                $.ajax({
                    url: '/customers/check-transaction-no',
                    type: 'GET',
                    success: function(data){
                        $('#code').val(data);
                    },
                });
            }
        });
        ";
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
                $code = 'C1';
            }
            else{
                $idx = intval(max($max->toArray())) + 1;
                $code = 'C' . $idx;
            }
            $this->inputs['code'] = $code;

            $id = DB::table($this->table)->insertGetId($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully added new data');
        }
    }

    public function checkTransactionNo(){
        $max = DB::table('customers')->pluck('code');
        foreach ($max as $key => $value) {
            $max[$key] = substr($value, 1);
        }
        if(count($max) ==  0){
            $code = 'C1';
        }
        else{
            $idx = intval(max($max->toArray())) + 1;
            $code = 'C' . $idx;
        }
        return $code;
    }

}
