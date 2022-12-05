<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends MNPController
{
    public function init(){
        $this->title = 'Dashboard';
    }

    public function getIndex(Request $request){

        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        $itemDB = DB::table("items")->get(); // ini awalnya buat test get img(ganti aja caranya klo mau)
        
        return view('home', ['title' => 'Dashboard', 'itemDB'=>$itemDB]);
    }

    public function getData(){
        $items = DB::table('items as a')
        ->join('brands as b', 'a.brand_id', 'b.id')
        ->select('a.name as item_name', 'a.id', 'b.name as brand_name', 'a.stock as stock')
        ->get();

        return $items;
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

}
