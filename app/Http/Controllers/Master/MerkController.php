<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class MerkController extends Controller
{
    public function getIndex(){
        return view('master.item.main', ['title' => 'Items']);
    }

    public function getAddItems(){
        return view('master.item.form', ['title' => 'Items']);
    }
}
