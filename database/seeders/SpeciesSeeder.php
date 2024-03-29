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

        $bfSpGroup = \App\Models\Speciesgroup::create(['name' => 'butterflies', 'description' => 'butterflies', 'usercancount' => true, 'imageLocation' => "img/butterflies.png", 'visibible_for_users'=> true]);
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
        $bfSpGroup->save();

        $mothSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'moths', 'description' => 'moths', 'usercancount' => true, 'imageLocation' => 'img/moths.png']);
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
        $mothSpeciesGroup->save();

   //     $beesSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'bees', 'description' => 'bees', 'usercancount' => true, 'imageLocation' => 'img/bees.png', 'visibible_for_users' => true]);
     /*   $defBee = \App\Models\Species::create([
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
        $beesSpeciesGroup->save(); */

        $beesSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'bumblebees', 'description' => 'Bumblebees', 'usercancount' => true, 'imageLocation' => 'img/bumblebees.png', 'visibible_for_users' => true]);
        $defBee = \App\Models\Species::create([
            'genus' => 'bumblebees',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/apidae',
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
        $beesSpeciesGroup->save();

        $beesSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'solitarybees', 'description' => 'Solitary bees', 'usercancount' => true, 'imageLocation' => 'img/solitarybees.png', 'visibible_for_users' => true]);
        $defBee = \App\Models\Species::create([
            'genus' => 'solitarybees',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/apidaesolo',
            'speciesgroup_id' => $beesSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'solitary bees',
       //     'imagelocation' => '',
            'nlname' => 'solitaire bijen',
            'enname' => 'solitary bees' 
        ]);
        $beesSpeciesGroup->defaultspecies_id = $defBee->id;
        $beesSpeciesGroup->save();

        $beesSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'honeybees', 'description' => 'Honey bees', 'usercancount' => true, 'imageLocation' => 'img/honeybees.png', 'visibible_for_users' => true]);
        $defBee = \App\Models\Species::create([
            'genus' => 'honeybees',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/apidaehoney',
            'speciesgroup_id' => $beesSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'honey bees',
       //     'imagelocation' => '',
            'nlname' => 'honing bijen',
            'enname' => 'honey bees' 
        ]);
        $beesSpeciesGroup->defaultspecies_id = $defBee->id;
        $beesSpeciesGroup->save();

        $hvSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'hoverflies', 'description' => 'Hoverflies', 'usercancount' => true, 'imageLocation' => 'img/hoverflies.png', 'visibible_for_users' => true]);
        $defHv = \App\Models\Species::create([
            'genus' => 'syrphidae',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/syrphidae',
            'speciesgroup_id' => $hvSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'hoverflies',
       //     'imagelocation' => '',
            'nlname' => 'zweefvliegen',
            'enname' => 'hoverflies' 
        ]);
        $hvSpeciesGroup->defaultspecies_id = $defHv->id;
        $hvSpeciesGroup->save();

        $flySpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'flies', 'description' => 'Flies', 'usercancount' => true, 'imageLocation' => 'img/flies.png', 'visibible_for_users' => true]);
        $defFly = \App\Models\Species::create([
            'genus' => 'diptera',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/diptera',
            'speciesgroup_id' => $flySpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'flies',
       //     'imagelocation' => '',
            'nlname' => 'vliegen',
            'enname' => 'flies' 
        ]);
        $flySpeciesGroup->defaultspecies_id = $defFly->id;
        $flySpeciesGroup->save();

        $beetleSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'beetles', 'description' => 'Beetles', 'usercancount' => true, 'imageLocation' => 'img/beetles.png', 'visibible_for_users' => true]);
        $defBeetle = \App\Models\Species::create([
            'genus' => 'coleoptera',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/coleoptera',
            'speciesgroup_id' => $beetleSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'beetles',
       //     'imagelocation' => '',
            'nlname' => 'kevers',
            'enname' => 'beetles' 
        ]);
        $beetleSpeciesGroup->defaultspecies_id = $defBeetle->id;
        $beetleSpeciesGroup->save();

        $bugSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'bugs', 'description' => 'Bugs', 'usercancount' => true, 'imageLocation' => 'img/bugs.png', 'visibible_for_users' => true]);
        $defBug = \App\Models\Species::create([
            'genus' => 'insecta',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/insecta',
            'speciesgroup_id' => $bugSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'bug',
       //     'imagelocation' => '',
            'nlname' => 'insect',
            'enname' => 'bug' 
        ]);
        $bugSpeciesGroup->defaultspecies_id = $defBug->id;
        $bugSpeciesGroup->save();
        $waspsSpeciesGroup = \App\Models\Speciesgroup::create(['name' => 'wasps', 'description' => 'Wasps', 'usercancount' => true, 'imageLocation' => 'img/wasps.png', 'visibible_for_users' => true]);
        $defWasp = \App\Models\Species::create([
            'genus' => 'wasps',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/categories/specieslist/wasps',
            'speciesgroup_id' => $waspsSpeciesGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'wasp',
       //     'imagelocation' => '',
            'nlname' => 'wesp',
            'enname' => 'wasp' 
        ]);
        $waspsSpeciesGroup->defaultspecies_id = $defWasp->id;
        $waspsSpeciesGroup->save();


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
            'enname' => 'plants' 
        ]);
        $plantSpGroup->defaultspecies_id = $defPlant->id;
        $plantSpGroup->save();

   /*     $birdSpGroup = \App\Models\Speciesgroup::create(['name' => 'birds', 'description' => 'birds', 'usercancount' => false, 'imageLocation' => 'img/birds.png', 'visibible_for_users' => true]);
        $defBird = \App\Models\Species::create([
            'genus' => 'aves',
            'taxon' => '',
            'ndffuri' => 'http://ndff-ecogrid.nl/taxonomy/taxa/aves',
            'speciesgroup_id' => $birdSpGroup->id,
            'taxrank' => 'speciesgroup',
            'diurnal' => false,
        //    'parent_id' => '',
            'description' => 'birds',
       //     'imagelocation' => '',
            'nlname' => 'vogels',
            'enname' => 'birds' 
        ]);
        $birdSpGroup->defaultspecies_id = $defBird->id;
        $birdSpGroup->save();
*/
        //create the species for each group 
 /*       \App\Models\Species::create([
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
*/
        \App\Models\Species::create(['genus' => 'Not specified', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Not specified', 'nlname' => 'Not specified']);
        \App\Models\Species::create(['genus' => 'Acacia', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Acacia', 'nlname' => 'Acacia']);
        \App\Models\Species::create(['genus' => 'Almond', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Almond', 'nlname' => 'Almond']);
        \App\Models\Species::create(['genus' => 'Apple', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Apple', 'nlname' => 'Apple']);
        \App\Models\Species::create(['genus' => 'Armeria', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Armeria', 'nlname' => 'Armeria']);
        \App\Models\Species::create(['genus' => 'Blackthorn', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Blackthorn', 'nlname' => 'Blackthorn']);
        \App\Models\Species::create(['genus' => 'Borage familty', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Borage familty', 'nlname' => 'Borage familty']);
        \App\Models\Species::create(['genus' => 'Bramble', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Bramble', 'nlname' => 'Bramble']);
        \App\Models\Species::create(['genus' => 'Butterfly bush', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Butterfly bush', 'nlname' => 'Butterfly bush']);
        \App\Models\Species::create(['genus' => 'Cabbage familiy', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Cabbage familiy', 'nlname' => 'Cabbage familiy']);
        \App\Models\Species::create(['genus' => 'Caper bush', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Caper bush', 'nlname' => 'Caper bush']);
        \App\Models\Species::create(['genus' => 'Cistus', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Cistus', 'nlname' => 'Cistus']);
        \App\Models\Species::create(['genus' => 'Clover', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Clover', 'nlname' => 'Clover']);
        \App\Models\Species::create(['genus' => 'Fan palm', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Fan palm', 'nlname' => 'Fan palm']);
        \App\Models\Species::create(['genus' => 'Hawthorn', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Hawthorn', 'nlname' => 'Hawthorn']);
        \App\Models\Species::create(['genus' => 'Heather', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Heather', 'nlname' => 'Heather']);
        \App\Models\Species::create(['genus' => 'Hemp-agrimony', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Hemp-agrimony', 'nlname' => 'Hemp-agrimony']);
        \App\Models\Species::create(['genus' => 'Ivy', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Ivy', 'nlname' => 'Ivy']);
        \App\Models\Species::create(['genus' => 'Jujube', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Jujube', 'nlname' => 'Jujube']);
        \App\Models\Species::create(['genus' => 'Knapweed', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Knapweed', 'nlname' => 'Knapweed']);
        \App\Models\Species::create(['genus' => 'Lavender', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Lavender', 'nlname' => 'Lavender']);
        \App\Models\Species::create(['genus' => 'Lillies', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Lillies', 'nlname' => 'Lillies']);
        \App\Models\Species::create(['genus' => 'Lupin', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Lupin', 'nlname' => 'Lupin']);
        \App\Models\Species::create(['genus' => 'Mint family', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Mint family', 'nlname' => 'Mint family']);
        \App\Models\Species::create(['genus' => 'Mixed wildflowers', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Mixed wildflowers', 'nlname' => 'Mixed wildflowers']);
        \App\Models\Species::create(['genus' => 'Myrtle', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Myrtle', 'nlname' => 'Myrtle']);
        \App\Models\Species::create(['genus' => 'Other Asteraceae', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Other Asteraceae', 'nlname' => 'Other Asteraceae']);
        \App\Models\Species::create(['genus' => 'Other Legumes', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Other Legumes', 'nlname' => 'Other Legumes']);
        \App\Models\Species::create(['genus' => 'Pear', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Pear', 'nlname' => 'Pear']);
        \App\Models\Species::create(['genus' => 'Quince', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Quince', 'nlname' => 'Quince']);
        \App\Models\Species::create(['genus' => 'Rapeseed', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Rapeseed', 'nlname' => 'Rapeseed']);
        \App\Models\Species::create(['genus' => 'Scabious', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Scabious', 'nlname' => 'Scabious']);
        \App\Models\Species::create(['genus' => 'Statice', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Statice', 'nlname' => 'Statice']);
        \App\Models\Species::create(['genus' => 'Strawberry tree', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Strawberry tree', 'nlname' => 'Strawberry tree']);
        \App\Models\Species::create(['genus' => 'Sunflower', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Sunflower', 'nlname' => 'Sunflower']);
        \App\Models\Species::create(['genus' => 'Thistles', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Thistles', 'nlname' => 'Thistles']);
        \App\Models\Species::create(['genus' => 'Umbellifers', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Umbellifers', 'nlname' => 'Umbellifers']);
        \App\Models\Species::create(['genus' => 'Yellow Asteraceae', 'speciesgroup_id' => $plantSpGroup->id, 'taxrank' => 'species', 'diurnal' => false,'description' =>'Yellow Asteraceae', 'nlname' => 'Yellow Asteraceae']);

        

        \App\Models\Species::create(['genus' => 'Papilio', 'taxon' => 'machaon', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'koninginnenpage','enname' => 'Swallowtail','esname' => 'Macaón','sename' => 'Makaonfjäril']);
        \App\Models\Species::create(['genus' => 'Ochlodes', 'taxon' => 'sylvanus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'groot dikkopje','enname' => 'Large Skipper','esname' => 'Dorada difusa','sename' => 'Ängssmygare']);
        \App\Models\Species::create(['genus' => 'Hesperia', 'taxon' => 'comma', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kommavlinder','enname' => 'Silver-spotted Skipper','esname' => 'Dorada manchas blancas','sename' => 'Silversmygare']);
        \App\Models\Species::create(['genus' => 'Thymelicus', 'taxon' => 'acteon', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'dwergdikkopje','enname' => 'Lulworth Skipper','esname' => 'Dorada oscura','sename' => '']);
        \App\Models\Species::create(['genus' => 'Thymelicus', 'taxon' => 'sylvestris', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'geelsprietdikkopje','enname' => 'Small Skipper','esname' => 'Dorada puntas claras','sename' => 'Större tåtelsmygare']);
        \App\Models\Species::create(['genus' => 'Thymelicus', 'taxon' => 'lineola', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'zwartsprietdikkopje','enname' => 'Essex Skipper','esname' => 'Dorada puntas negras','sename' => 'Mindre tåtelsmygare']);
        \App\Models\Species::create(['genus' => 'Spialia', 'taxon' => 'sertorius', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'Kalkgraslanddikkopje','enname' => 'Red-underwing Skipper','esname' => 'Sertorio','sename' => '']);
        \App\Models\Species::create(['genus' => 'Carcharodus', 'taxon' => 'alceae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kaasjeskruiddikkopje','enname' => 'Mallow Skipper','esname' => 'Piquitos de las malvas','sename' => '']);
        \App\Models\Species::create(['genus' => 'Muschampia', 'taxon' => 'proto', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Sage Skipper','esname' => 'Proto','sename' => '']);
        \App\Models\Species::create(['genus' => 'Carcharodus', 'taxon' => 'baeticus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Southern Marbled Skipper','esname' => 'Piquitos del marrubio','sename' => '']);
        \App\Models\Species::create(['genus' => 'Erynnis', 'taxon' => 'tages', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bruin dikkopje','enname' => 'Dingy Skipper','esname' => 'Cervantes','sename' => 'Skogsvisslare']);
        \App\Models\Species::create(['genus' => 'Pyrgus', 'taxon' => 'malvae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'aardbeivlinder','enname' => 'Grizzled Skipper','esname' => '','sename' => 'Smultronvisslare']);
        \App\Models\Species::create(['genus' => 'Leptidea', 'taxon' => 'sinapis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'boswitje','enname' => 'Wood White','esname' => 'Esbelta común','sename' => 'Skogsvitvinge']);
        \App\Models\Species::create(['genus' => 'Leptidea', 'taxon' => 'sinapis/juvernica', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Wood/Cryptic Wood White','esname' => '','sename' => 'Skogsvitvinge/Ängsvitvinge']);
        \App\Models\Species::create(['genus' => 'Gonepteryx', 'taxon' => 'rhamni', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'citroenvlinder','enname' => 'Brimstone','esname' => 'Limonera','sename' => 'Citronfjäril']);
        \App\Models\Species::create(['genus' => 'Gonepteryx', 'taxon' => 'cleopatra', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'cleopatra','enname' => 'Cleopatra','esname' => 'Cleopatra','sename' => '']);
        \App\Models\Species::create(['genus' => 'Colias', 'taxon' => 'alfacariensis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'zuidelijke luzernevlinder','enname' => 'Bergers Clouded Yellow','esname' => 'Colias pálida','sename' => 'Sydlig höfjäril']);
        \App\Models\Species::create(['genus' => 'Colias', 'taxon' => 'crocea', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'oranje luzernevlinder','enname' => 'Clouded Yellow','esname' => 'Colias común','sename' => 'Rödgul höfjäril']);
        \App\Models\Species::create(['genus' => 'Aporia', 'taxon' => 'crataegi', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'groot geaderd witje','enname' => 'Black-veined White','esname' => 'Blanca del majuelo','sename' => 'Hagtornsfjäril']);
        \App\Models\Species::create(['genus' => 'Pontia', 'taxon' => 'daplidice', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'groot geaderd witje','enname' => 'Bath White','esname' => 'Blanquiverdosa','sename' => 'Grönfläckig vitfjäril']);
        \App\Models\Species::create(['genus' => 'Pieris', 'taxon' => 'brassicae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'groot koolwitje','enname' => 'Large White','esname' => 'Blanca de la col','sename' => 'Kålfjäril']);
        \App\Models\Species::create(['genus' => 'Pieris', 'taxon' => 'rapae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'klein koolwitje','enname' => 'Small White','esname' => 'Blanquita de la col','sename' => 'Rovfjäril']);
        \App\Models\Species::create(['genus' => 'Pieris', 'taxon' => 'mannii', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'scheefbloemwitje','enname' => 'Southern Small White','esname' => 'Blanca de Mann','sename' => 'Sydlig rovfjäril']);
        \App\Models\Species::create(['genus' => 'Pieris', 'taxon' => 'napi', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'klein geaderd witje','enname' => 'Green-veined White','esname' => 'Blanca verdinervada','sename' => 'Rapsfjäril']);
        \App\Models\Species::create(['genus' => 'Euchloe', 'taxon' => 'crameri', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Western Dappled White','esname' => 'Blanquiverdosa común','sename' => '']);
        \App\Models\Species::create(['genus' => 'Anthocharis', 'taxon' => 'euphenoides', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Provence Orange-tip','esname' => 'Aurora amarilla','sename' => '']);
        \App\Models\Species::create(['genus' => 'Anthocharis', 'taxon' => 'cardamines', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'oranjetipje','enname' => 'Orange-tip','esname' => 'Aurora blanca','sename' => 'Aurorafjäril']);
        \App\Models\Species::create(['genus' => 'Lycaena', 'taxon' => 'alciphron', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Purple-shot Copper','esname' => 'Manto púrpura','sename' => 'Ametistguldvinge']);
        \App\Models\Species::create(['genus' => 'Lycaena', 'taxon' => 'hippothoe', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'rode vuurvlinder','enname' => 'Purple-edged Copper','esname' => 'Manto cobrizo','sename' => 'Violettkantad guldvinge']);
        \App\Models\Species::create(['genus' => 'Lycaena', 'taxon' => 'phlaeas', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kleine vuurvlinder','enname' => 'Small Copper','esname' => 'Manto común','sename' => 'Mindre guldvinge']);
        \App\Models\Species::create(['genus' => 'Lycaena', 'taxon' => 'virgaureae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'morgenrood','enname' => 'Scarce Copper','esname' => 'Manto de oro','sename' => 'Vitfläckig guldvinge']);
        \App\Models\Species::create(['genus' => 'Thecla', 'taxon' => 'betulae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'sleedoornpage','enname' => 'Brown Hairstreak','esname' => 'Topacio','sename' => 'Eldsnabbvinge']);
        \App\Models\Species::create(['genus' => 'Favonius', 'taxon' => 'quercus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'eikenpage','enname' => 'Purple Hairstreak','esname' => 'Nazarena','sename' => 'Eksnabbvinge']);
        \App\Models\Species::create(['genus' => 'Tomares', 'taxon' => 'ballus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Provence Hairstreak','esname' => 'Cardenillo','sename' => '']);
        \App\Models\Species::create(['genus' => 'Callophrys', 'taxon' => 'rubi', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'groentje','enname' => 'Green Hairstreak','esname' => 'Cejiblanca','sename' => 'Grönsnabbvinge']);
        \App\Models\Species::create(['genus' => 'Satyrium', 'taxon' => 'w-album', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'iepenpage','enname' => 'White-letter Hairstreak','esname' => 'Rabicorta w-blanca','sename' => 'Almsnabbvinge']);
        \App\Models\Species::create(['genus' => 'Satyrium', 'taxon' => 'spini', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'wegedoornpage','enname' => 'Blue-spot Hairstreak','esname' => 'Rabicorta de mancha azul','sename' => '']);
        \App\Models\Species::create(['genus' => 'Lampides', 'taxon' => 'boeticus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'tijgerblauwtje','enname' => 'Long-tailed Blue','esname' => 'Estriada canela','sename' => 'Långsvansad blåvinge']);
        \App\Models\Species::create(['genus' => 'Cacyreus', 'taxon' => 'marshalli', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'geraniumblauwtje','enname' => 'Geranium Bronze','esname' => 'Taladro del geranio','sename' => 'Trädgårdsblåvinge']);
        \App\Models\Species::create(['genus' => 'Celastrina', 'taxon' => 'argiolus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'boomblauwtje','enname' => 'Holly Blue','esname' => 'Náyade','sename' => 'Tosteblåvinge']);
        \App\Models\Species::create(['genus' => 'Glaucopsyche', 'taxon' => 'melanops', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Black-eyed Blue','esname' => 'Melanops','sename' => '']);
        \App\Models\Species::create(['genus' => 'Glaucopsyche', 'taxon' => 'alexis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Green-underside Blue','esname' => 'Alexis','sename' => 'Klöverblåvinge']);
        \App\Models\Species::create(['genus' => 'Zizeeria', 'taxon' => 'knysna', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'African Grass Blue','esname' => 'Violetilla','sename' => '']);
        \App\Models\Species::create(['genus' => 'Cupido', 'taxon' => 'argiades', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'staartblauwtje','enname' => 'Short-tailed Blue','esname' => 'Duende naranjitas','sename' => 'Kortsvansad blåvinge']);
        \App\Models\Species::create(['genus' => 'Cupido', 'taxon' => 'minimus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'dwergblauwtje','enname' => 'Small Blue','esname' => 'Duende menor','sename' => 'Mindre blåvinge']);
        \App\Models\Species::create(['genus' => 'Cupido', 'taxon' => 'lorquinii', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Lorquins Blue','esname' => 'Duende azul','sename' => '']);
        \App\Models\Species::create(['genus' => 'Plebejus', 'taxon' => 'argus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => '','esname' => 'Esmaltada espinosa/sencilla','sename' => 'Ljung/Hedblåvinge']);
        \App\Models\Species::create(['genus' => 'Plebejus', 'taxon' => 'argus/idas', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => '','esname' => 'Esmaltada espinosa/sencilla','sename' => 'Ljung/Hedblåvinge']);
        \App\Models\Species::create(['genus' => 'Kretania', 'taxon' => 'hesperica', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Spanish Zephyr Blue','esname' => 'Niña del astrágalo','sename' => '']);
        \App\Models\Species::create(['genus' => 'Cyaniris', 'taxon' => 'semiargus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'klaverblauwtje','enname' => 'Mazarine Blue','esname' => 'Semiargus','sename' => 'Ängsblåvinge']);
        \App\Models\Species::create(['genus' => 'Aricia', 'taxon' => 'cramera', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Southern Brown Argus','esname' => 'Morena común','sename' => '']);
        \App\Models\Species::create(['genus' => 'Aricia', 'taxon' => 'artaxerxes', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Northern Brown Argus','esname' => '','sename' => 'Midsommarblåvinge']);
        \App\Models\Species::create(['genus' => 'Aricia', 'taxon' => 'agestis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bruin blauwtje','enname' => 'Brown Argus','esname' => 'Morena oriental','sename' => 'Rödfläckig blåvinge']);
        \App\Models\Species::create(['genus' => 'Lysandra', 'taxon' => 'bellargus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Adonis Blue','esname' => 'Niña celeste','sename' => '']);
        \App\Models\Species::create(['genus' => 'Lysandra', 'taxon' => 'coridon', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bleek blauwtje','enname' => 'Chalkhill Blue','esname' => 'Niña coridón','sename' => '']);
        \App\Models\Species::create(['genus' => 'Lysandra', 'taxon' => 'albicans', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Spanish Chalkhill Blue','esname' => 'Niña andaluza','sename' => '']);
        \App\Models\Species::create(['genus' => 'Polyommatus', 'taxon' => 'thersites', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Chapmans Blue','esname' => 'Niña tersites','sename' => '']);
        \App\Models\Species::create(['genus' => 'Polyommatus', 'taxon' => 'amandus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'icarusblauwtje','enname' => 'Common Blue','esname' => 'Ícaro','sename' => 'Puktörneblåvinge']);
        \App\Models\Species::create(['genus' => 'Polyommatus', 'taxon' => 'icarus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'icarusblauwtje','enname' => 'Common Blue','esname' => 'Ícaro','sename' => 'Puktörneblåvinge']);
        \App\Models\Species::create(['genus' => 'Limenitis', 'taxon' => 'reducta', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'blauwe ijsvogelvlinder','enname' => 'Southern White Admiral','esname' => 'Ninfa de los arroyos','sename' => '']);
        \App\Models\Species::create(['genus' => 'Issoria', 'taxon' => 'lathonia', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kleine parelmoervlinder','enname' => 'Queen of Spain Fritillary','esname' => 'Espejitos','sename' => 'Storfläckig pärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Brenthis', 'taxon' => 'ino', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'purperstreepparelmoervlinder','enname' => 'Lesser Marbled Fritillary','esname' => 'Bipunteada ino','sename' => 'Älggräspärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Argynnis', 'taxon' => 'paphia', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'keizersmantel','enname' => 'Silver-washed Fritillary','esname' => 'Nacarada pafia','sename' => 'Silverstreckad pärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Argynnis', 'taxon' => 'pandora', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'tsarenmantel','enname' => 'Cardinal','esname' => 'Nacarada pandora','sename' => '']);
        \App\Models\Species::create(['genus' => 'Speyeria', 'taxon' => 'aglaja', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'grote parelmoervlinder','enname' => 'Dark Green Fritillary','esname' => 'Nacarada aglaja','sename' => 'Ängspärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Fabriciana', 'taxon' => 'niobe', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'duinparelmoervlinder','enname' => 'Niobe Fritillary','esname' => 'Nacarada niobe','sename' => 'Hedpärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Fabriciana', 'taxon' => 'adippe', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bosrandparelmoervlinder','enname' => 'High Brown Fritillary','esname' => 'Nacarada adipe','sename' => 'Skogspärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Boloria', 'taxon' => 'selene', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'zilveren maan','enname' => 'Small Pearl-bordered Fritillary','esname' => 'Perlada selene','sename' => 'Brunfläckig pärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Boloria', 'taxon' => 'euphrosyne', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'zilvervlek','enname' => 'Pearl-bordered Fritillary','esname' => 'Perlada rojiza','sename' => 'Prydlig pärlemorfjäril']);
        \App\Models\Species::create(['genus' => 'Araschnia', 'taxon' => 'levana', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'landkaartje','enname' => 'Map','esname' => 'Levana','sename' => 'Kartfjäril']);
        \App\Models\Species::create(['genus' => 'Vanessa', 'taxon' => 'cardui', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'distelvlinder','enname' => 'Painted Lady','esname' => 'Cardera','sename' => 'Tistelfjäril']);
        \App\Models\Species::create(['genus' => 'Vanessa', 'taxon' => 'atalanta', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'atalanta','enname' => 'Red Admiral','esname' => 'Atalanta','sename' => 'Amiral']);
        \App\Models\Species::create(['genus' => 'Aglais', 'taxon' => 'io', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'dagpauwoog','enname' => 'Peacock','esname' => 'Pavo real','sename' => 'Påfågelöga']);
        \App\Models\Species::create(['genus' => 'Aglais', 'taxon' => 'urticae', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kleine vos','enname' => 'Small Tortoiseshell','esname' => 'Ortiguera','sename' => 'Nässelfjäril']);
        \App\Models\Species::create(['genus' => 'Polygonia', 'taxon' => 'c-album', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'gehakkelde aurelia','enname' => 'Comma','esname' => 'C-blanca','sename' => 'Vinbärsfuks']);
        \App\Models\Species::create(['genus' => 'Nymphalis', 'taxon' => 'polychloros', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'grote vos','enname' => 'Large Tortoiseshell','esname' => 'Olmera','sename' => 'Körsbärsfuks']);
        \App\Models\Species::create(['genus' => 'Nymphalis', 'taxon' => 'antiopa', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'rouwmantel','enname' => 'Camberwell Beauty','esname' => 'Antiopa','sename' => 'Sorgmantel']);
        \App\Models\Species::create(['genus' => 'Melitaea', 'taxon' => 'didyma', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'tweekleurige parelmoervlinder','enname' => 'Spotted Fritillary','esname' => 'Doncella didima','sename' => '']);
        \App\Models\Species::create(['genus' => 'Melitaea', 'taxon' => 'phoebe', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'knoopkruidparelmoervlinder','enname' => 'Knapweed Fritillary','esname' => 'Doncella mayor','sename' => '']);
        \App\Models\Species::create(['genus' => 'Melitaea', 'taxon' => 'athalia', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Heath Fritillary','esname' => 'Mariposa del almez','sename' => 'Skogsnätfjäril']);
        \App\Models\Species::create(['genus' => 'Libythea', 'taxon' => 'celtis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'monarchvlinder','enname' => 'Nettle-tree Butterfly','esname' => 'Mariposa monarca','sename' => '']);
        \App\Models\Species::create(['genus' => 'Danaus', 'taxon' => 'plexippus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Monarch','esname' => 'Mariposa tigre','sename' => 'Monark']);
        \App\Models\Species::create(['genus' => 'Danaus', 'taxon' => 'chrysippus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Plain Tiger','esname' => 'Cuatro colas','sename' => '']);
        \App\Models\Species::create(['genus' => 'Charaxes', 'taxon' => 'jasius', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'hooibeestje','enname' => 'Two-tailed Pasha','esname' => 'Ocelada común','sename' => 'Pasha']);
        \App\Models\Species::create(['genus' => 'Coenonympha', 'taxon' => 'pamphilus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'tweekleurig hooibeestje','enname' => 'Small Heath','esname' => 'Ocelada banda blanca','sename' => 'Kamgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Coenonympha', 'taxon' => 'arcania', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bont zandoogje','enname' => 'Pearly Heath','esname' => 'Ondulada','sename' => 'Pärlgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Pararge', 'taxon' => 'aegeria', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'rotsvlinder','enname' => 'Speckled Wood','esname' => 'Pedregosa','sename' => 'Kvickgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Lasiommata', 'taxon' => 'maera', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'argusvlinder','enname' => 'Large Wall Brown','esname' => 'Saltacercas','sename' => 'Vitgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Lasiommata', 'taxon' => 'megera', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Wall Brown','esname' => 'Medioluto ibérica','sename' => 'Svingelgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Melanargia', 'taxon' => 'lachesis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'dambordje','enname' => 'Iberian Marbled White','esname' => 'Medioluto norteña','sename' => '']);
        \App\Models\Species::create(['genus' => 'Melanargia', 'taxon' => 'galathea', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'kleine heivlinder','enname' => 'Marbled White','esname' => 'Sátiro gris','sename' => 'Schackbräde']);
        \App\Models\Species::create(['genus' => 'Hipparchia', 'taxon' => 'statilinus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Tree Grayling','esname' => 'Sátiro rayado','sename' => '']);
        \App\Models\Species::create(['genus' => 'Hipparchia', 'taxon' => 'fidia', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'heivlinder','enname' => 'Striped Grayling','esname' => 'Sátiro rubio','sename' => '']);
        \App\Models\Species::create(['genus' => 'Hipparchia', 'taxon' => 'semele', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Grayling','esname' => 'Sátiro negro','sename' => 'Sandgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Brintesia', 'taxon' => 'circe', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Great Banded Grayling','esname' => 'Briseis','sename' => '']);
        \App\Models\Species::create(['genus' => 'Satyrus', 'taxon' => 'actaea', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Black Satyr','esname' => 'Lobo','sename' => '']);
        \App\Models\Species::create(['genus' => 'Chazara', 'taxon' => 'briseis', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'koevinkje','enname' => 'The Hermit','esname' => 'Sortijitas','sename' => 'Vitbandad gräsfjäril']);
        \App\Models\Species::create(['genus' => 'Hyponephele', 'taxon' => 'lycaon', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Dusky Meadow Brown','esname' => 'Lobito listado','sename' => '']);
        \App\Models\Species::create(['genus' => 'Aphantopus', 'taxon' => 'hyperantus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'oranje zandoogje','enname' => 'Ringlet','esname' => 'Lobito jaspeado','sename' => 'Luktgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Pyronia', 'taxon' => 'cecilia', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Southern Gatekeeper','esname' => 'Lobito de banda blanca','sename' => '']);
        \App\Models\Species::create(['genus' => 'Pyronia', 'taxon' => 'tithonus', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => 'bruin zandoogje','enname' => 'Gatekeeper','esname' => 'Loba','sename' => 'Buskgräsfjäril']);
        \App\Models\Species::create(['genus' => 'Pyronia', 'taxon' => 'bathseba', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Spanish Gatekeeper','esname' => '','sename' => '']);
        \App\Models\Species::create(['genus' => 'Maniola', 'taxon' => 'jurtina', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Meadow Brown','esname' => '','sename' => 'Slåttergräsfjäril']);
        \App\Models\Species::create(['genus' => 'Erebia', 'taxon' => 'ligea', 'speciesgroup_id' => $bfSpGroup->id, 'taxrank' => 'species', 'diurnal' => false, 'nlname' => '','enname' => 'Arran Brown','esname' => '','sename' => 'Skogsgräsfjäril']);

    }
}
