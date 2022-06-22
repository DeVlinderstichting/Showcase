<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ManagementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ManagementType::create(['name' => 'ManagementType_agricultural', 'description'=> 'Plowing, poisoning, cutting etc']);
        \App\Models\ManagementType::create(['name' => 'ManagementType_agriculturalExtnesive', 'description'=> 'Cutting']);
        \App\Models\ManagementType::create(['name' => 'ManagementType_burning', 'description'=> 'Set fire to everything but the rain']);
        \App\Models\ManagementType::create(['name' => 'ManagementType_grazing', 'description'=> 'Grazing']);
    }
}
