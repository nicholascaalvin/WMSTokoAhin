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

    public function getIndex(){
        $this->init();
        $this->data['title'] = $this->title;
        $this->data['main'] = $this->main;

        $query = DB::table($this->table);
        $this->data['contents'] = $query->get();
        return view('template.main', $this->data);

        

        // if($this->table != ''){
        //     $data = DB::table($this->table)->get();
        //     return view('template.main', ['title' => $this->title, 'data' => $data]);
        // }
        // else{
        //     return view('template.main', ['title' => $this->title]);
        // }
        // $data = $this->data;
        
    }
}
