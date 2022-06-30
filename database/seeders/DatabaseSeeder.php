<?php

namespace Database\Seeders;

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
        $this->call([
            SpeciesSeeder::class,
            CountingMethodsSeeder::class,
            RecordingLevelsSeeder::class,
            LanduseTypesSeeder::class,
            ManagementTypesSeeder::class,
            LanguageSeeder::class,
            AdminAccountSeeder::class,
        //    TestDataSeeder::class,
        ]);
    }
}
