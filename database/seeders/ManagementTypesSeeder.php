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
        \App\Models\ManagementType::create(['name' => 'cropHarvesting', 'description'=> 'Crop harvesting']);
        \App\Models\ManagementType::create(['name' => 'managementtype_flowerstrip', 'description'=> 'Flowerstrip']);
        \App\Models\ManagementType::create(['name' => 'managementtype_grazing', 'description'=> 'Grazing']);
        \App\Models\ManagementType::create(['name' => 'managementtype_hedgerow', 'description'=> 'Hedgerow']);
        \App\Models\ManagementType::create(['name' => 'managementtype_mowing', 'description'=> 'Mowing']);
        \App\Models\ManagementType::create(['name' => 'managementtype_pesticideApplication', 'description'=> 'Pesticide application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_herbicideApplication', 'description'=> 'Herbicide application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_fungicideApplication', 'description'=> 'Fungicide application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_insecticideApplication', 'description'=> 'Insecticide application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_otherPesticideApplication', 'description'=> 'Other pesticides application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_fertiliserApplication', 'description'=> 'Fertiliser application']);
        \App\Models\ManagementType::create(['name' => 'managementtype_cultivation', 'description'=> 'Cultivation/tillage']);
        \App\Models\ManagementType::create(['name' => 'managementtype_irrigation', 'description'=> 'Irrigation']);
    }
}
