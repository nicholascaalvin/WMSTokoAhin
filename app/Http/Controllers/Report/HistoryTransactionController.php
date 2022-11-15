<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryTransactionController extends Controller
{
    public function getHistoryTransaction(){
        return view('Report.historytransaction', ["title" => "History Transaction"]);
    }
}
