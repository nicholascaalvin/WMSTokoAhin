<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
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
            DB::table('countries')->insert([
                [
                    'name' => 'Indonesia',
                    'company_id' => $value->id,
                ],
            ]);
        }
    }
}
