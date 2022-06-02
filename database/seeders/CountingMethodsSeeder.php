<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountingMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CountingMethod::create(['name' => 'single', 'description'=> 'single observation']);
        \App\Models\CountingMethod::create(['name' => 'timed', 'description'=> 'timed count']);
        \App\Models\CountingMethod::create(['name' => 'transect', 'description'=> 'transect']);
        \App\Models\CountingMethod::create(['name' => 'fit', 'description'=> 'flowerpatch count']);
    }
}
