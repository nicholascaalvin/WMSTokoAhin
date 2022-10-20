<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class AislesController extends MNPController
{
    public function init(){
        $this->title = 'Aisles';
        $this->table = 'aisles';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Aisle Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Aisle Name', 'col' => 'name', 'required' => true];
    }

}
