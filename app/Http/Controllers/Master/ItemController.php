<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Request;
use DB;

date_default_timezone_set("Asia/Jakarta");

class ItemController extends Controller
{
    public function getIndex(){
        $items = DB::table('items')->get();
        return view('master.item.item', ['title' => 'Items', 'items' => $items]);
    }

    public function getAddItems(){
        return view('form', ['title' => 'Items']);
    }

    public function saveItems(){
        $request = Request::all();
        $code = Request::get('itemCode');
        $name = Request::get('itemName');
        $uom = Request::get('uom');
        $qty = Request::get('qty');
        $now = date('Y-m-d H:i:s');

        DB::table('items')->insert([
            'created_at' => $now,
            'code' => $code,
            'name' => $name,
            'uom' => $uom,
            'qty' => $qty,
            'incoming' => 0,
            'outgoing' => 0,
            'stock' => 0,
        ]);
        return redirect(url('items'));
    }
}
