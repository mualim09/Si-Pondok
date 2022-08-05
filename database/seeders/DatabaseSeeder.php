<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory()->create([
             'name' => 'Abdul Aziz',
             'email' => 'id.abdasis@gmail.com',
             'password' => bcrypt('rahasia123'),
         ]);

        // \App\Models\User::factory(10)->create();
        if (\App::environment('local')){
            $this->call([
                ProvincesSeeder::class,
                CitiesSeeder::class,
                DistrictsSeeder::class,
                VillagesSeeder::class,
                SantriSeeder::class,
                GuruSeeder::class,
            ]);
        }else{
            $this->call([
                ProvincesSeeder::class,
                CitiesSeeder::class,
                DistrictsSeeder::class,
                VillagesSeeder::class,
            ]);
        }
    }
}
