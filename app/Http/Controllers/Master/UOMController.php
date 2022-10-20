<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class UOMController extends MNPController
{
    public function init(){
        $this->title = 'Unit Of Measurements';
        $this->table = 'uoms';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'UOM Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'UOM Name', 'col' => 'name', 'required' => true];
    }
}
