<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = DB::table('companies')->get();
        foreach ($companies as $key => $value) {
            DB::table('uoms')->insert([
                [
                    'name' => 'Pack',
                    'company_id' => $value->id,
                ],
                [
                    'name' => 'Pieces',
                    'company_id' => $value->id,
                ],
            ]);
        }
    }
}
