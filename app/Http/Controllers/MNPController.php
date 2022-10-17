<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

date_default_timezone_set("Asia/Jakarta");

class MNPController extends Controller
{
    // public $title;
    public $table = '';
    public $title = '';
    public $main = [];
    public $forms = [];

    public function init(){
    }

    public function query(){
        return DB::table($this->table)->where('company_id', Helper::getCompanyId());
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
                    $like = $index;
                    $col = $dt;
                }
            }
        }
        $this->inputs['created_at'] = $now;
        $this->inputs['company_id'] = Helper::getCompanyId();
        $exist = DB::table($this->table)->where('company_id', $this->inputs['company_id'])->whereRaw($like." like '%$col%'")->get();
        if(count($exist) > 0){
            return redirect()->back()->with('error', 'Data existed!')->withInput();
        }
        else{
            DB::table($this->table)->insert($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully added new data');
        }
    }

    public function delete(Request $request){
        $this->load();
        $id = $request->all()['id'];
        $return = 'success';
        try {
            // DB::table($this->table)->where('id', $id)->delete();
        } catch (\Throwable $th) {
            $return = 'currently used';
        }
        return $return;
    }
}
