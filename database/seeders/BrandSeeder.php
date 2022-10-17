<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
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
            DB::table('brands')->insert([
                [
                    'name' => 'No Brand',
                    'company_id' => $value->id,
                ],
            ]);
        }
    }
}
