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
        $defBf = \App\Models\Species::create([
            'genus' => 'lepidoptera',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/lepidoptera',
            'speciesgroup_id' => $bfSpGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'butterflies',
       //     'imagelocation' => '',
            'nlname' => 'vlinders',
            'enname' => 'butterflies' 
        ]);
        $bfSpGroup->defaultspecies_id = $defBf->id;

        $mothSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'moths', 'description' => 'moths', 'usercancount' => true]);
        $defMoth = \App\Models\Species::create([
            'genus' => 'heterocera',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/heterocera',
            'speciesgroup_id' => $mothSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'moths',
       //     'imagelocation' => '',
            'nlname' => 'nachtvlinders',
            'enname' => 'moths' 
        ]);
        $mothSpeciesGroup->defaultspecies_id = $defMoth->id;

        $beesSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'bees', 'description' => 'bees', 'usercancount' => true]);
        $defBee = \App\Models\Species::create([
            'genus' => 'apoidea',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/apoidea',
            'speciesgroup_id' => $beesSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'bees',
       //     'imagelocation' => '',
            'nlname' => 'bijen',
            'enname' => 'bees' 
        ]);
        $beesSpeciesGroup->defaultspecies_id = $defBee->id;

        $plantSpGroup = \App\Models\Speciesgroup::create(['name' => 'plants', 'description' => 'plants', 'usercancount' => false]);
        $defPlant = \App\Models\Species::create([
            'genus' => 'plantae',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/plantae',
            'speciesgroup_id' => $plantSpGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'plants',
       //     'imagelocation' => '',
            'nlname' => 'planten',
            'enname' => 'plant' 
        ]);
        $plantSpGroup->defaultspecies_id = $defPlant->id;

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

        \App\Models\Species::create([
            'genus' => 'Vinca',
            'taxon' => 'minor',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/vincaminor',
            'speciesgroup_id' => $plantSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
            'description' => 'a small plant with green leafs',
            'nlname' => 'Vinca',
            'enname' => 'Vinca' 
        ]);
        \App\Models\Species::create([
            'genus' => 'Taraxacum ',
            'taxon' => 'officinalis',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/taraxacumofficinalis',
            'speciesgroup_id' => $plantSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
            'description' => 'a small plant with green leafs',
            'nlname' => 'Paardenbloem',
            'enname' => 'Horseflour' 
        ]);
        \App\Models\Species::create([
            'genus' => 'Daucus ',
            'taxon' => 'carota',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/daucuscarota',
            'speciesgroup_id' => $plantSpGroup->id,
            'taxrank' => 'species',
            'diurnal' => false,
            'description' => 'a small plant with green leafs',
            'nlname' => 'Wilde peen',
            'enname' => 'Wild root' 
        ]);

    }
}
