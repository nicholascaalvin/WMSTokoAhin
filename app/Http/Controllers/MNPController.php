<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Auth;

date_default_timezone_set("Asia/Jakarta");

class MNPController extends Controller
{
    // public $title;
    public $table = '';
    public $title = '';
    public $main = [];

    public function init(){
    }

    public function load(){
        $this->init();
        $this->data['title'] = $this->title;
        $this->data['main'] = $this->main;
        $this->data['table'] = $this->table;
        $query = DB::table($this->table);
        $this->data['contents'] = $query->get();
        $url = $_SERVER['REQUEST_URI'];
        $this->data['url'] = $url;
        $this->data['add'] = $url.'/add';
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

    public function save(){
        $this->load();
        $name = Request::get('name');
        $now = date('Y-m-d H:i:s');
        $company_id = Auth::user()->company_id;
        dd($name, $now, $company_id);
        $exist = DB::table($this->data['table'])->where('company_id', $company_id)->whereRaw("name like '%$name%'")->first();
        if ($exist) {
            return 'error';
        }
        else{
            DB::table($this->data['table'])->insert([
                'created_at' => $now,
                'name' => $name,
                'company_id' => $company_id,
            ]);
            return 'success';
        }
    }
}
