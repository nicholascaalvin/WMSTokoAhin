<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;


date_default_timezone_set("Asia/Jakarta");

class MNPController extends Controller
{
    // public $title;
    public $table = '';
    public $title = '';
    public $main = [];
    public $forms = [];
    public $details = [];

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
        $this->data['details'] = $this->details;

        if (isset($this->row)) {
            $this->data['row'] = $this->row->get();
        }

        $query = $this->query();
        $this->data['contents'] = $query->get();

        $url = $_SERVER['REQUEST_URI'];
        $this->data['url'] = $url;
        if(count(explode('/', $this->data['url'])) == 2){
            $this->data['add'] = $url.'/add';
        }
        // dd($this->data);
        $this->data['forms'] = $this->forms;
    }

    public function getIndex(){
        $this->load();

        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('template.main', $this->data);
    }

    public function getAdd(){
        $this->load();

        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('template.form', $this->data);
    }

    public function getDetail($id){
        $this->load();
        $this->data['contents'] = $this->data['contents']->where('id', $id)->first();
        $url = explode('/', $this->data['url']);
        $this->data['page'] = $url[2];
        // dd($this->data['row']);

        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('template.detail', $this->data);
    }

    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $page = explode('/', $this->data['url']);
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
        if($page[2] == 'edit'){
            $this->inputs['updated_at'] = $now;
            $id = $page[3];
            DB::table($this->table)->where('id', $id)->where('company_id', Helper::getCompanyId())->update($this->inputs);
            return redirect('/'.$this->table)->with('success', 'Successfully edited the data');
        }
        else{
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
    }

    public function delete(Request $request){
        $this->load();
        $id = $request->all()['id'];
        try {
            DB::table($this->table)->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Successfully deleted data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'This data is currently in used!');
        }
    }
}
