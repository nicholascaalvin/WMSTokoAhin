<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class CustomerController extends MNPController
{
    public function init(){
        $this->title = 'Customer';
        $this->table = 'customers';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true, 'search' => 'skip'];
        $this->main[] = ['label' => 'Customer Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Customer Name', 'col' => 'name', 'required' => true];
    }

}
