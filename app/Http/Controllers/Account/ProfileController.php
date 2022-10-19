<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\MNPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class ProfileController extends MNPController
{
    public function init(){
        $this->title = 'Profile';
        $this->table = 'users';

        $this->forms[] = ['label' => 'Name', 'col' => 'name'];
        $this->forms[] = ['label' => 'Email', 'col' => 'email'];
        $this->forms[] = ['label' => 'Password', 'col' => 'password'];

    }

    public function getDetail($id){
        $this->load();

        if($locale = session('locale')){
            app()->setLocale($locale);
        }
        return view('template.form', $this->data);
    }

    public function save(Request $request){
        $this->load();
        $this->inputs = [];
        $page = explode('/', $this->data['url']);
        $request = $request->all();
        $now = date('Y-m-d H:i:s');

        $status = 'true';
        foreach ($request as $key => $value) {
            if($value != null){
                if($key == 'email'){
                    if(!str_contains($value, '@')){
                        $status = 'email gaada @';
                    }
                    if(!str_contains($value, '.com')){
                        $status = 'email gaada .com';
                    }
                    $users = DB::table('users')->get();
                    foreach ($users as $index => $data) {
                        if($value == $data->email){
                            $status = 'email sama';
                        }
                    }
                }
                if($key == 'password'){
                    if(count($value) < 8){
                        $status = 'password kurang dari 8';
                    }
                }
            }
        }
        if($status != 'true') {
            return back()->with('error', 'Please fill the form correctly');
        }

        foreach ($this->forms as $key => $value) {
            foreach ($request as $index => $dt) {
                if($index == $value['col']){
                    $this->inputs[$value['col']] = $dt;
                }
            }
        }
        $this->inputs['updated_at'] = $now;
        foreach ($this->inputs as $key => $value) {
            if($value != null){
                $id = $page[3];
                if($key == 'password'){
                    DB::table($this->table)->where('id', $id)->where('company_id', Helper::getCompanyId())->update([
                        $key => Hash::make($value),
                    ]);
                }
                else{
                    DB::table($this->table)->where('id', $id)->where('company_id', Helper::getCompanyId())->update([$key => $value]);
                }
            }
        }
        return redirect()->back()->with('success', 'Successfully edited the data');
    }

    // public function getIndex(){
    //     $this->load();
        
    //     if($locale = session('locale')){
    //         app()->setLocale($locale);
    //     }

    //     $this->data['page'] = 'edit';

    //     // dd($this->data);
    //     return view('template.detail', $this->data);
    // }

    /*
    public function switch($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }
    */
}
