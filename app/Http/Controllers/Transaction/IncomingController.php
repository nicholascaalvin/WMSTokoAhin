<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;

class IncomingController extends MNPController
{
    public function init(){
        $this->title = 'Incoming';
        $this->table = 'incoming';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'display' => 'none'];
        $this->main[] = ['label' => 'Voucher No', 'col' => 'voucher_no'];
        $this->main[] = ['label' => 'Transaction Date', 'col' => 'trans_date'];

        $this->forms[] = ['label' => 'Voucher No', 'col' => 'voucher_no', 'required' => true];
        $this->forms[] = ['label' => 'Transaction Date', 'col' => 'trans_date', 'required' => true];
    }
    // public function getIndex(){
    //     return view('transaction.incoming.main');
    // }
}
