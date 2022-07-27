<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Toko Ahin',
            ],
            [
                'name' => 'Toko Aciu',
            ]
        ]);
    }
}
