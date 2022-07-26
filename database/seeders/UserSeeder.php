<?php

namespace Database\Seeders;

use App\Models\Company;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = DB::table('companies')->get();
        $nama_toko = array();
        foreach ($companies as $key => $value) {
            $string = explode(' ', $value->name);
            array_push($nama_toko, $string[1]);
        }
        $index = 1;
        for ($i=0; $i < count($nama_toko); $i++) {
            DB::table('users')->insert([
                'name' => 'Admin ' . $nama_toko[$i],
                'email' => strtolower($nama_toko[$i]) . '@admin.com',
                'password' => Hash::make('admin'),
                'company_id' => $index,
            ]);
            $index++;
        }

    }
}
