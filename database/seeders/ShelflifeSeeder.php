<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShelflifeSeeder extends Seeder
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
            for ($i=1; $i <= 5; $i++) {
                DB::table('shelflifes')->insert([
                    [
                        'periods' => $i.' Weeks',
                        'company_id' => $value->id,
                    ],
                    [
                        'periods' => $i.' Months',
                        'company_id' => $value->id,
                    ],
                ]);
            }
        }
    }
}
