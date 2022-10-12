<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Country;
// use Request;

date_default_timezone_set("Asia/Jakarta");

class MNPController extends Controller
{
    // public $title;
    public $table = '';
    public $title = '';
    public $main = [];

    public function init(){
    }

    public function query(){
        return DB::table($this->table);
    }

    public function load(){
        $this->init();
        $this->data['title'] = $this->title;
        $this->data['main'] = $this->main;
        $this->data['table'] = $this->table;

        $query = $this->query();
        $this->data['contents'] = $query->get();

        $url = $_SERVER['REQUEST_URI'];
        $this->data['url'] = $url;
        if(count(explode('/', $this->data['url'])) == 2){
            $this->data['add'] = $url.'/add';
        }

        $this->data['forms'] = $this->forms;
    }

    public function getIndex(){
        $this->load();
        return view('template.main', $this->data);
    }

    public function getAdd(){
        $this->load();
        return view('template.form', $this->data);
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $request = $request->all();
        $now = date('Y-m-d H:i:s');
        foreach ($this->forms as $key => $value) {
            foreach ($request as $index => $dt) {
                if($index == $value['col']){
                    $this->inputs[$value['col']] = $dt;
                }
            }
        }
        $this->inputs['created_at'] = $now;
        $this->inputs['company_id'] = Helper::getCompanyId();
        DB::table($this->table)->insert($this->inputs);
        return redirect('/'.$this->table)->with('success', 'Successfully added new data');

        // $url = $request->url();
        // $header = $request->header();
        // dd($url, $header, $data);
        // $name = $request->input('name');
        // dd($name);
        // // $name = Request::get('name');
        // $now = date('Y-m-d H:i:s');
        // // $company_id = Auth::user()->company_id;
        // dd($name, $now, $company_id);
        // $exist = DB::table($this->data['table'])->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        // if ($exist) {
        //     return 'error';
        // }
        // else{
        //     DB::table($this->data['table'])->insert([
        //         'created_at' => $now,
        //         'name' => $name,
        //         'company_id' => $company_id,
        //     ]);
        //     return 'success';
        // }
    }
}
