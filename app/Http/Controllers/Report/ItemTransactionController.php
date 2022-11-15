<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class ItemTransactionController extends Controller
{
    public function getItemTransaction(){
        return view('Report.itemtransaction', ["title" => "Item Transaction"]);
    }

    public  function search(Request $request){
         $request =$request->all();

         if($request['transaction_date'] != null){
            $request['transaction_date'] = explode(' to ', $request['transaction_date']);
            if (count($request['transaction_date']) == 1) {
                $start_date = $request['transaction_date'][0].' 00:00:00';
                $end_date = $request['transaction_date'][0].' 23:59:59';
            }else {
                $start_date = $request['transaction_date'][0].' 00:00:00';
                $end_date = $request['transaction_date'][1].' 23:59:59';
            }
        }

        $items_incoming = DB::table('items as a')
        ->Join("incomings_detail as b", 'a.id', 'b.item_id')
        ->Join("incomings as c", "c.id", "b.incomings_id")
        ->Join("aisles as d", "d.id", "b.aisle_id")
        ->select("a.name", "c.transaction_date", "d.name as aisle_name", "b.qty", DB::raw('"Incoming" as type'))
        ->where ('a.company_id', Helper::getCompanyId())
        ->orderBy('c.transaction_date');

        $items_outgoing = DB::table('items as a')
        ->Join("outgoings_detail as b", 'a.id', 'b.item_id')
        ->Join("outgoings as c", "c.id", "b.outgoings_id")
        ->Join("aisles as d", "d.id", "b.aisle_id")
        ->select("a.name", "c.transaction_date", "d.name as aisle_name", "b.qty", DB::raw('"Outgoing" as type'))
        ->where ('a.company_id', Helper::getCompanyId())
        ->orderBy('c.transaction_date');

        if($request['item_name'] != null){
            $items_incoming->where('a.name', 'LIKE', '%'.$request['item_name'].'%');
            $items_outgoing->where('a.name', 'LIKE', '%'.$request['item_name'].'%');
        }
        $query = $items_outgoing->union($items_incoming);
        return $query->orderBy("transaction_date")->get();
    
    }
}