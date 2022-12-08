<?php

namespace App\Http\Controllers\Report;

use App\Exports\HistoryTransactionExport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;

class HistoryTransactionController extends Controller
{
    public function getHistoryTransaction(){
        return view('Report.historytransaction', ["title" => "History Transaction"]);
    }

    public function search(Request $request){
        $request = $request->all();

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

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->join('vendors as e', 'a.vendor_id', 'e.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'e.name as ppl', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Incoming" as type'), 'd.name as aisle_name')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->join('customers as e', 'a.customer_id', 'e.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'e.name as ppl', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Outgoing" as type'), 'd.name as aisle_name')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        if($request['transaction_no'] != null){
            $incomings->where('a.transaction_no', 'LIKE', '%'.$request['transaction_no'].'%');
            $outgoings->where('a.transaction_no', 'LIKE', '%'.$request['transaction_no'].'%');
        }
        if($request['transaction_date'] != null){
            $incomings->whereBetween('a.transaction_date', [$start_date, $end_date]);
            $outgoings->whereBetween('a.transaction_date', [$start_date, $end_date]);
        }

        $query = $outgoings->union($incomings);
        return $query->orderBy('transaction_date', 'ASC')->get();
    }

    public function export(Request $request){
        $request = $request->all();

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

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->join('vendors as e', 'a.vendor_id', 'e.id')
        ->select('a.transaction_no', 'a.transaction_date', 'e.name', 'c.name as item_name', 'b.qty', DB::raw('"Incoming" as type'), 'd.name as aisle_name')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->join('customers as e', 'a.customer_id', 'e.id')
        ->select('a.transaction_no', 'a.transaction_date', 'e.name', 'c.name as item_name', 'b.qty',  DB::raw('"Outgoing" as type'), 'd.name as aisle_name')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        if($request['transaction_no'] != null){
            $incomings->where('a.transaction_no', 'LIKE', '%'.$request['transaction_no'].'%');
            $outgoings->where('a.transaction_no', 'LIKE', '%'.$request['transaction_no'].'%');
        }
        if($request['transaction_date'] != null){
            $incomings->whereBetween('a.transaction_date', [$start_date, $end_date]);
            $outgoings->whereBetween('a.transaction_date', [$start_date, $end_date]);
        }

        $query = $outgoings->union($incomings);
        $query->orderBy('transaction_date', 'ASC');
        return Excel::download(new HistoryTransactionExport($query), 'History_Transaction'.now()->timestamp.'.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
