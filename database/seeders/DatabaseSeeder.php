<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([

            
            UserSeeder::class,
            SecteurSeeder::class,
            
            RegionSeeder::class,
            EntrepriseSeeder::class,
            
            CondidatSeeder::class,
            AdminSeeder::class,
            OffreSeeder::class,
            DocumentSeeder::class,
            
            

        ]);
    }
}
