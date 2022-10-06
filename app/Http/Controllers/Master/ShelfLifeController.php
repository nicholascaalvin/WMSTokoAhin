<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;
use PDO;

date_default_timezone_set("Asia/Jakarta");

class ShelfLifeController extends Controller
{
    public function getIndex(){
        $data = DB::table('shelflife')->get();
        return view('master.shelflife.main', [
            'title' => 'Shelf Life',
            'data' => $data,
        ]);
    }

    public function getAddShelflife(){
        return view('master.shelflife.form', [
            'title' => 'Shelf Life',
        ]);
    }

    public function searchShelflife(){
        dd('search');
    }
}
