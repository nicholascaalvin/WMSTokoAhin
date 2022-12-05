<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;


class HomeController extends MNPController
{
    public function init(){
        $this->title = 'Dashboard';

        $this->forms[] = ['label' => 'Company Name', 'type' => 'newUser', 'col' => 'name', 'required' => true];
    }

    public function getIndex(Request $request){

        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Incoming" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Outgoing" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');


        $incomings->whereBetween('a.transaction_date', [date("Y-m-d").' 00:00:00', date("Y-m-d").' 23:59:59']);
        $outgoings->whereBetween('a.transaction_date', [date("Y-m-d").' 00:00:00', date("Y-m-d").' 23:59:59']);

        $transaction = $outgoings->union($incomings);
        $transaction->orderBy(DB::raw('IFNULL(updated_at, created_at)'));

        return view('home', ['title' => 'Dashboard', 'transactions' => $transaction->paginate(5)]);
    }

    public function getData(){
        $items = DB::table('items as a')
        ->join('brands as b', 'a.brand_id', 'b.id')
        ->select('a.name as item_name', 'a.id', 'b.name as brand_name', 'a.stock as stock')
        ->get();

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Incoming" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Outgoing" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        ->orderBy('a.id');


        $incomings->whereBetween('a.transaction_date', [date("Y-m-d").' 00:00:00', date("Y-m-d").' 23:59:59']);
        $outgoings->whereBetween('a.transaction_date', [date("Y-m-d").' 00:00:00', date("Y-m-d").' 23:59:59']);

        $transaction = $outgoings->union($incomings);

        $data = [
            'items' => $items,
            'transactions' => $transaction->orderBy(DB::raw('IFNULL(updated_at, created_at)'))->paginate(1)
        ];

        return $data;
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function saveNewUser(Request $request){
        $request = $request->all();
        $company_name = explode('Toko ', $request['name']);
        $company_id = DB::table('companies')->insertGetId(['name' => $request['name']]);
        DB::table('users')->insert([
            'name' => 'Admin '.$company_name[1],
            'email' => strtolower($company_name[1]).'@admin.com',
            'password' => Hash::make('admin'),
            'company_id' => $company_id,
        ]);
        DB::table('aisles')->insert([
            [
                'name' => 'A',
                'company_id' => $company_id,
            ],
            [
                'name' => 'B',
                'company_id' => $company_id,
            ],
            [
                'name' => 'C',
                'company_id' => $company_id,
            ],
        ]);
        DB::table('brands')->insert([
            [
                'name' => '-',
                'company_id' => $company_id,
            ],
        ]);
        DB::table('countries')->insert([
            [
                'name' => 'Indonesia',
                'company_id' => $company_id,
            ],
        ]);
        DB::table('uoms')->insert([
            [
                'name' => 'Pack',
                'company_id' => $company_id,
            ],
            [
                'name' => 'Pieces',
                'company_id' => $company_id,
            ],
        ]);
        return redirect('/dashboard');
    }

}
