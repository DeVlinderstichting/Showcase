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
        \App\Models\CountingMethod::create(['name' => 'single']);
        \App\Models\CountingMethod::create(['name' => 'timed']);
        \App\Models\CountingMethod::create(['name' => 'transect']);
        \App\Models\CountingMethod::create(['name' => 'fit']);
    }
}
