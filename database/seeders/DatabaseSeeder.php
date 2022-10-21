<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            CountrySeeder::class,
            UOMSeeder::class,
            BrandSeeder::class,
            AisleSeeder::class,
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
