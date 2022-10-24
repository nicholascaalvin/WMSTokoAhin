<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class IncomingController extends MNPController
{
    public function init(){
        $this->title = 'Incoming';
        $this->table = 'incomings';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Transaction No', 'col' => 'transaction_no'];
        $this->main[] = ['label' => 'Transaction Date', 'col' => 'transaction_date'];

        $this->forms[] = ['label' => 'Transaction No', 'col' => 'transaction_no', 'readonly' => true];
        $this->forms[] = ['label' => 'Transaction Date', 'col' => 'transaction_date', 'type' => 'datetime', 'datetime_type' => 'datetime', 'required' => true];
        $this->forms[] = ['label' => 'Vendor', 'col' => 'vendor_id', 'type' => 'select2', 'select2_table' => 'vendors', 'required' => true];

        $this->details[] = ['label' => 'Item Name', 'col' => 'detail_item_id', 'select2' => 'items', 'required' => true];
        $this->details[] = ['label' => 'Quantity', 'col' => 'detail_item_qty', 'type' => 'number',  'required' => true];

        $page = explode('/', Helper::getCurrentUrl());
        if(count($page) > 3){
            $this->row = DB::table('incomings as a')
                ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
                ->join('items as c', 'b.item_id', 'c.id')
                ->select('a.id', 'a.transaction_no', 'a.transaction_date', 'a.vendor_id', 'c.name', 'b.qty', 'c.id', 'b.incomings_id')
                ->where('a.company_id', Helper::getCompanyId())
                ->where('b.incomings_id', $page[3])
                ->groupBy('a.id', 'a.transaction_no', 'a.transaction_date', 'a.vendor_id', 'c.name', 'b.qty', 'c.id', 'b.incomings_id')
                ->orderBy('b.id');
        }
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $request = $request->all();
        $request['transaction_date'] = date('Y-m-d H:i:00', strtotime($request['transaction_date']));
        $page = explode('/', $this->data['url']);
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

        $transaction_no = DB::table($this->table)->pluck('transaction_no');
        foreach ($transaction_no as $key => $value) {
            $transaction_no[$key] = substr($value, 8);
        }
        if(count($transaction_no) ==  0){
            $transaction_no = 'IC/' . date('ym') . '/1';
        }
        else{
            $transaction_no = intval(max($transaction_no->toArray())) + 1;
            $transaction_no = 'IC/' . date('ym') . '/' . $transaction_no;
        }

        $this->inputs['transaction_no'] = $transaction_no;
        $this->inputs['created_at'] = $now;
        $this->inputs['company_id'] = Helper::getCompanyId();

        $detail_item_id = $request['item_id'];
        $detail_item_qty = $request['item_qty'];

        $header_exist = DB::table($this->table)->where('id', $page[3])->where('company_id', Helper::getCompanyId())->first();
        if ($header_exist) {
            $this->inputs['updated_at'] = $now;
            DB::table($this->table)->where('id', $page[3])->where('company_id', Helper::getCompanyId())->update($this->inputs);
            $created_at = DB::table('incomings_detail')->where('incomings_id', $page[3])->where('company_id', Helper::getCompanyId())->pluck('created_at')->first();
            DB::table('incomings_detail')->where('incomings_id', $page[3])->where('company_id', Helper::getCompanyId())->delete();
            foreach ($detail_item_id as $key => $value) {
                DB::table('incomings_detail')->insert([
                    'created_at' => $created_at,
                    'updated_at' => $now,
                    'incomings_id' => $page[3],
                    'item_id' => $value,
                    'qty' => $detail_item_qty[$key],
                    'company_id' => Helper::getCompanyId(),
                ]);
                $this->updateStock($value, $detail_item_qty[$key]);
            }
            return redirect('/'.$this->table)->with('success', 'Successfully edited the data');
        }
        else{
            $incomings_id = DB::table($this->table)->insertGetId($this->inputs);
            foreach ($detail_item_id as $key => $value) {
                DB::table('incomings_detail')->insert([
                    'created_at' => $now,
                    'incomings_id' => $incomings_id,
                    'item_id' => $value,
                    'qty' => $detail_item_qty[$key],
                    'company_id' => Helper::getCompanyId(),
                ]);
                $this->updateStock($value, $detail_item_qty[$key]);
            }
            return redirect('/'.$this->table)->with('success', 'Successfully added new data');
        }
    }

    public function deleteDetails($id){
        DB::table('items')->where('company_id', Helper::getCompanyId())->update([
            'incoming' => 0,
        ]);
        DB::table('incomings_detail')->where('company_id', Helper::getCompanyId())->where('incomings_id', $id)->delete();
        $this->updateAllStock();
    }

    public function updateStock($item_id, $qty){
        $current_qty = DB::table('items')->where('id', $item_id)->where('company_id', Helper::getCompanyId())->pluck('incoming')->first();
        $current_qty += $qty;
        DB::table('items')->where('id', $item_id)->where('company_id', Helper::getCompanyId())->update([
            'incoming' => $current_qty,
        ]);
    }
}
