<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AisleSeeder extends Seeder
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
            DB::table('aisles')->insert([
                [
                    'name' => 'A',
                    'company_id' => $value->id,
                ],
                [
                    'name' => 'B',
                    'company_id' => $value->id,
                ],
                [
                    'name' => 'C',
                    'company_id' => $value->id,
                ],
            ]);
        }
    }
}
