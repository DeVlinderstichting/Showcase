<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //first create the speciesgroups

        $bfSpGroup = \App\Models\Speciesgroup::create(['name' => 'butterflies', 'description' => 'butterflies', 'usercancount' => true]);
        \App\Models\Speciesgroup::create(['name' => 'moths', 'description' => 'moths', 'usercancount' => true]);
        \App\Models\Speciesgroup::create(['name' => 'bees', 'description' => 'bees', 'usercancount' => true]);

        //create the species for each group 
        \App\Models\Species::create([
            'genus' => 'aglais',
            'taxon' => 'io',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/inachisio',
            'speciesgroup_id' => $bfSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'a large red butterfly with eyes',
       //     'imagelocation' => '',
            'nlname' => 'dagpauwoog',
            'enname' => 'european peacock' 
        ]);
         \App\Models\Species::create([
            'genus' => 'agriades',
            'taxon' => 'optilete',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/plebeiusoptilete',
            'speciesgroup_id' => $bfSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'a small blue beautifull butterfly',
       //     'imagelocation' => '',
            'nlname' => 'veenbesblauwtje',
            'enname' => 'cranberry blue' 
        ]);
          \App\Models\Species::create([
            'genus' => 'aglais',
            'taxon' => 'urticae',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/aglaisurticae',
            'speciesgroup_id' => $bfSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'a large red that looks like a fox or tortoise depending on who you ask',
       //     'imagelocation' => '',
            'nlname' => 'kleine vos',
            'enname' => 'small tortoiseshell' 
        ]);

    }
}