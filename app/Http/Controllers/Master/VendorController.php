<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class VendorController extends MNPController
{

    public function init(){
        $this->title = 'Vendors';
        $this->table = 'vendors';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Vendor Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Vendor Name', 'col' => 'name', 'required' => true];
    }

}
