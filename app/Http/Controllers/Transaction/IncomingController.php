<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function getIndex(){
        return view('transaction.incoming.main');
    }
}
