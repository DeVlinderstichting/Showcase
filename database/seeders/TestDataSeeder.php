<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::create(['key' => '123key', 'nl'=>"ik ben een test", 'fr'=>'je suis Napoleon', 'en'=>'I dunno man']);
        \App\Models\Language::create(['key' => '456key', 'nl'=>"ik ben bloedserieus", 'fr'=>'je suis Napoleon', 'en'=>'I dunno what to say duuuude']);
        
        // General stuff
        \App\Models\Language::create(['key' => 'closeButton', 'en'=>'Close']);
        \App\Models\Language::create(['key' => 'saveButton', 'en'=>'Save']);
        \App\Models\Language::create(['key' => 'cancelButton', 'en'=>'Cancel']);
        \App\Models\Language::create(['key' => 'startButton', 'en'=>'Start']);
        \App\Models\Language::create(['key' => 'infoButton', 'en'=>'MORE INFO']);
        \App\Models\Language::create(['key' => 'searchSpeciesLabel', 'en'=>'SEARCH SPECIES']);
        
        // Nav Bar
        \App\Models\Language::create(['key' => 'navStatistics', 'en'=>'STATISTICS']);
        \App\Models\Language::create(['key' => 'navSettings', 'en'=>'SETTINGS']);
        \App\Models\Language::create(['key' => 'navMessages', 'en'=>'MESSAGES']);

        // Home Screen
        \App\Models\Language::create(['key' => 'homeSpecialTitle', 'en'=>'I SAW SOMETHING SPECIAL']);
        \App\Models\Language::create(['key' => 'homeSpecialDescr', 'en'=>'Opportunistic observation']);
        \App\Models\Language::create(['key' => 'home15mTitle', 'en'=>'15 MINUTES COUNT']);
        \App\Models\Language::create(['key' => 'home15mDescr', 'en'=>'Opportunistic observation']);
        \App\Models\Language::create(['key' => 'homeTransectTitle', 'en'=>'WALK TRANSECT']);
        \App\Models\Language::create(['key' => 'homeTransectDescr', 'en'=>'Walk a predifined transect and record everything you see']);
        \App\Models\Language::create(['key' => 'homeFitTitle', 'en'=>'FIT COUNT']);
        \App\Models\Language::create(['key' => 'homeFitDescr', 'en'=>'Observe a single flower, record everything you see interacting with that flower']);

        // Special Observation screen
        \App\Models\Language::create(['key' => 'specialTitle', 'en'=>'I SAW SOMETHING SPECIAL']);
        \App\Models\Language::create(['key' => 'specialDescr', 'en'=>'Opportunistic observation. <br>Enter your data!']);
        \App\Models\Language::create(['key' => 'specialNumberLabel', 'en'=>'NUMBER OBSERVED']);
        \App\Models\Language::create(['key' => 'specialInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'specialInfoModalContents', 'en'=>'Here is more information about opportunistic observations']);
        \App\Models\Language::create(['key' => 'specialInfoModalSpeciesTitle', 'en'=>'Species information']);
        \App\Models\Language::create(['key' => 'specialInfoModalSpeciesContents', 'en'=>'For extra info on this species see click the link underneath (opens outside of this application):']);


        $user = \App\Models\User::create(['name'=> 'SirTestington','email'=> 'test@vlinderstichting.nl', 'password'=> Hash::make('123test'), 'accesstoken' => '123token']);
        $user->setRandomAccessToken();
        $user->save();

        $spGroup = \App\Models\SpeciesGroup::where('name', 'butterflies')->first();
        $recordingLevel = \App\Models\RecordingLevel::first();
        $speciesGroupsUsers = \App\Models\SpeciesgroupsUsers::create(['user_id' => $user->id, 'speciesgroup_id' => $spGroup->id, 'recordinglevel_id' => $recordingLevel->id]);

        $spGroup = \App\Models\SpeciesGroup::where('name', 'bees')->first();
        $recordingLevel = \App\Models\RecordingLevel::first();
        $speciesGroupsUsers = \App\Models\SpeciesgroupsUsers::create(['user_id' => $user->id, 'speciesgroup_id' => $spGroup->id, 'recordinglevel_id' => $recordingLevel->id]);

        $spGroup = \App\Models\SpeciesGroup::where('name', 'birds')->first();
        $recordingLevel = \App\Models\RecordingLevel::first();
        $speciesGroupsUsers = \App\Models\SpeciesgroupsUsers::create(['user_id' => $user->id, 'speciesgroup_id' => $spGroup->id, 'recordinglevel_id' => $recordingLevel->id]);

        $user2 = \App\Models\User::create(['name'=> 'admin','email'=> 'admin', 'isadmin'=>true, 'password'=> Hash::make('123test'), 'accesstoken' => '123token']);
        $user2->setRandomAccessToken();
        $user2->save();

        $region = \App\Models\Region::create(['name' => 'test epa', 'description' => 'fluffy cloud city']);
        //$user->regions()->attach($region);
        \App\Models\RegionsUsers::create(['region_id' => $region->id, 'user_id' => $user->id]);

        $allSp = \App\Models\Species::all();
        foreach($allSp as $sp)
        {
            \App\Models\RegionsSpecies::create(['region_id' => $region->id, 'species_id' => $sp->id]);
          //  $region->species()->attach($sp);
        }

        $tr = \App\Models\Transect::create(['name' => 'testTransect']);
        \App\Models\TransectSections::create(['name' => '1', 'transect_id' => $tr->id, 'sequence' => '1']);
        \App\Models\TransectSections::create(['name' => '2', 'transect_id' => $tr->id, 'sequence' => '2']);
        \App\Models\TransectSections::create(['name' => '3', 'transect_id' => $tr->id, 'sequence' => '3']);        
        $tr2 = \App\Models\Transect::create(['name' => 'testTransect2']);
        
        \App\Models\TransectSections::create(['name' => '1', 'transect_id' => $tr2->id, 'sequence' => '1']);
        \App\Models\TransectSections::create(['name' => '2', 'transect_id' => $tr2->id, 'sequence' => '2']);
        \App\Models\TransectSections::create(['name' => '3', 'transect_id' => $tr2->id, 'sequence' => '3']);        
        \App\Models\TransectsUsers::create(['transect_id'=> $tr->id, 'user_id' => $user->id]);
        \App\Models\TransectsUsers::create(['transect_id'=> $tr2->id, 'user_id' => $user->id]);
    }
}
