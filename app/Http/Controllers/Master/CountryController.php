<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\MNPController;

class CountryController extends MNPController
{
    public function init(){
        $this->title = 'Countries';
        $this->table = 'countries';

        $this->main[] = ['label' => 'id', 'col' => 'id', 'input' => true];
        $this->main[] = ['label' => 'Country Name', 'col' => 'name'];

        $this->forms[] = ['label' => 'Country Name', 'col' => 'name', 'required' => true];
    }
}
