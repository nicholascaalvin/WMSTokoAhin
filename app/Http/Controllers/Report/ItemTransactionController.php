<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemTransactionController extends Controller
{
    public function getItemTransaction(){
        return view('Report.itemtransaction', ["title" => "Item Transaction"]);
    }
}
