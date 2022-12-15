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

        if(Helper::getCompanyId() == 1){
            $this->table = 'Users';
            $this->forms[] = ['label' => 'Company Name', 'type' => 'newUser', 'col' => 'name', 'required' => true];
        }

    }

    public function query(){
        if(Helper::getCompanyId() == 1){
            $query = DB::table('companies');
            return $query;
        }
    }

    public function getIndex(Request $request){

        if($locale = session('locale')){
            app()->setLocale($locale);
        }

        $this->loadStock();

        $year = date('Y');

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Incoming" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        // ->whereYear('a.transaction_date', $year)
        ->orderBy('a.transaction_date', 'DESC');

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select('a.id as header_id', 'b.id as detail_id', 'a.transaction_no', 'a.transaction_date', 'b.item_id', 'b.qty', 'c.name as item_name', DB::raw('"Outgoing" as type'), 'd.name as aisle_name', 'a.created_at', 'b.updated_at')
        ->where('a.company_id', Helper::getCompanyId())
        // ->whereYear('a.transaction_date', $year)
        ->orderBy('a.transaction_date', 'DESC');

        $transaction = $outgoings->union($incomings);
        $transaction->orderBy(DB::raw('IFNULL(updated_at, created_at)'), 'DESC');
        // dd($transaction->get());

        $items = DB::table('items as a')
        ->join('brands as b', 'a.brand_id', 'b.id')
        ->select('a.name as item_name', 'a.id', 'b.name as brand_name', 'a.stock as stock')
        ->where('a.company_id', Helper::getCompanyId())
        ->get();

        return view('home', ['title' => 'Dashboard', 'transactions' => $transaction->take(5)->get(), 'items' => $items]);
    }

    public function getData(){

        $this->loadStock();

        $items = DB::table('items as a')
        ->join('brands as b', 'a.brand_id', 'b.id')
        ->select('a.name as item_name', 'a.id', 'b.name as brand_name', 'a.stock as stock')
        ->where('a.company_id', Helper::getCompanyId())
        ->get();

        $incomings = DB::table('incomings as a')
        ->join('incomings_detail as b', 'a.id', 'b.incomings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select(DB::raw('MONTH(a.transaction_date) as transaction_date'),DB::raw("sum(b.qty) as qty"))
        ->groupBy(DB::raw('MONTH(a.transaction_date)'))
        ->where(DB::raw('YEAR(a.transaction_date)'), '=', date('Y'))
        ->where('a.company_id', Helper::getCompanyId());

        $outgoings = DB::table('outgoings as a')
        ->join('outgoings_detail as b', 'a.id', 'b.outgoings_id')
        ->join('items as c', 'b.item_id', 'c.id')
        ->join('aisles as d', 'b.aisle_id', 'd.id')
        ->select(DB::raw('MONTH(a.transaction_date) as transaction_date'), DB::raw("sum(b.qty) as qty"))
        ->groupBy(DB::raw('MONTH(a.transaction_date)'))
        ->where(DB::raw('YEAR(a.transaction_date)'), '=', date('Y'))
        ->where('a.company_id', Helper::getCompanyId());

        $data = [
            'items' => $items,
            'incomings' => $incomings->get(),
            'outgoings' => $outgoings->get(),
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

    public function deleteUser($id){
        $user = DB::table('users')->where('id', $id)->first();
        DB::table('aisles')->where('company_id', $user->company_id)->delete();
        DB::table('brands')->where('company_id', $user->company_id)->delete();
        DB::table('categories')->where('company_id', $user->company_id)->delete();
        DB::table('countries')->where('company_id', $user->company_id)->delete();
        DB::table('customers')->where('company_id', $user->company_id)->delete();
        DB::table('incomings')->where('company_id', $user->company_id)->delete();
        DB::table('items')->where('company_id', $user->company_id)->delete();
        DB::table('outgoings')->where('company_id', $user->company_id)->delete();
        DB::table('uoms')->where('company_id', $user->company_id)->delete();
        DB::table('vendors')->where('company_id', $user->company_id)->delete();
        DB::table('users')->where('company_id', $user->company_id)->delete();
        DB::table('companies')->where('id', $user->company_id)->delete();
        return redirect()->back();
    }

    public function loadStock(){
        $data = DB::table('items')->where('company_id', Helper::getCompanyId())->get();
        foreach ($data as $key => $value) {
            $stock = $value->incoming - $value->outgoing;
            DB::table('items')->where('id', $value->id)->where('company_id', Helper::getCompanyId())->update([
                'stock' => $stock,
            ]);
        }
    }

}
