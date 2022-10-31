<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class BrandController extends MNPController
{

    public function init(){
        $this->title = 'Brands';
        $this->table = 'brands';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Brand Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Brand Name', 'col' => 'name', 'required' => true];
    }

}
