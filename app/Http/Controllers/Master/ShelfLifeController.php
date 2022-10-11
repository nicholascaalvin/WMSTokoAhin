<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;
use Request;
use DB;
use Auth;
use PDO;

class ShelfLifeController extends MNPController
{
    public function init()
    {
        $this->title = 'Shelf Life';
        $this->table = 'shelflife';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'display' => 'none'];
        $this->main[] = ['label' => 'Shelf Life', 'col' => 'name'];

        $this->forms[] = ['label' => 'Periods', 'col' => 'name'];
    }

    /*
    public function getIndex(){
        $data = DB::table('shelflife')->get();
        return view('master.shelflife.main', [
            'title' => 'Shelf Life',
            'data' => $data,
        ]);
    }

    public function getAddShelflifes(){
        return view('master.shelflife.form', [
            'title' => 'Shelf Life',
        ]);
    }

    public function searchShelflifes(){
        dd('search');
    }
    */
}
