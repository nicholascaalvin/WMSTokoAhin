<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class ShelfLifeController extends MNPController
{
    public function init()
    {
        $this->title = 'Shelf Life';
        $this->table = 'shelflifes';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Shelf Life', 'col' => 'periods'];

        $this->forms[] = ['label' => 'Periods', 'col' => 'periods', 'required' => true];
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
