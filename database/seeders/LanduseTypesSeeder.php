<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanduseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\LanduseType::create(['name' => 'landusetype_agricultural', 'description'=> 'Area in agricultural use']);
        \App\Models\LanduseType::create(['name' => 'landusetype_agriculturalExtnesive', 'description'=> 'Area in extensive agricultural use']);
        \App\Models\LanduseType::create(['name' => 'landusetype_Living', 'description'=> 'Residential area']);
        \App\Models\LanduseType::create(['name' => 'landusetype_Heathland', 'description'=> 'A heathland']);
    }
}
