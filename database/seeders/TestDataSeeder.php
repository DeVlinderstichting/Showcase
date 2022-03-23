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

        $fitCom = \App\Models\CountingMethod::where('name', 'fit')->first();
        $singleCom = \App\Models\CountingMethod::where('name', 'single')->first();
        $transectCom = \App\Models\CountingMethod::where('name', 'transect')->first();
        $timedCom = \App\Models\CountingMethod::where('name', 'timed')->first();
        $speciesGroupRecordingLevels = [];
        $speciesGroupRecordingLevel1 = \App\Models\MethodSpeciesgroupRecordinglevel::create(['recordinglevel_id' => \App\Models\RecordingLevel::where('name', 'species')->first()->id, 'speciesgroup_id' => \App\Models\Speciesgroup::where('name', 'butterflies')->first()->id]);
        $speciesGroupRecordingLevel2 = \App\Models\MethodSpeciesgroupRecordinglevel::create(['recordinglevel_id' => \App\Models\RecordingLevel::where('name', 'group')->first()->id, 'speciesgroup_id' => \App\Models\Speciesgroup::where('name', 'bees')->first()->id]);
        $speciesGroupRecordingLevels[] = $speciesGroupRecordingLevel1;
        $speciesGroupRecordingLevels[] = $speciesGroupRecordingLevel2;

        $method = \App\Models\Method::getMethod($speciesGroupRecordingLevels);
        $rawGeom = '{ "type":"Point","coordinates":[6.23188379999999,52.2457984]}';
        $geom = \DB::raw("ST_GeomFromGeoJSON('".$rawGeom."')");
        $theVisit = \App\Models\Visit::create(['countingmethod_id' => $singleCom->id,'startdate' => '2022-01-02 12:01:03','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','region_id' => '1','method_id' => $method->id, 'location' => $geom]);
        $sp = \App\Models\Species::where('nlname', 'koninginnenpage')->first();
        \App\Models\Observation::create(['species_id' => $sp->id,'observationtime' => '2022-01-02 12:23:03','number' => 3,'visit_id' => $theVisit->id, 'location' => $geom]);
        $sp2 = \App\Models\Species::where('nlname', 'aardbeivlinder')->first();
        \App\Models\Observation::create(['species_id' => $sp2->id,'observationtime' => '2022-01-02 12:23:03','number' => 1,'visit_id' => $theVisit->id, 'location' => $geom]);
        $sp3 = \App\Models\Species::where('nlname', 'dagpauwoog')->first();
        \App\Models\Observation::create(['species_id' => $sp3->id,'observationtime' => '2022-01-02 12:23:03','number' => 6,'visit_id' => $theVisit->id, 'location' => $geom]);

        $theVisit2 = \App\Models\Visit::create(['countingmethod_id' => $singleCom->id,'startdate' => '2022-01-02 12:01:03','status' => '2','user_id' => $user2->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','region_id' => '1','method_id' => $method->id, 'location' => $geom]);
        \App\Models\Observation::create(['species_id' => $sp->id,'observationtime' => '2022-01-02 12:23:03','number' => 1,'visit_id' => $theVisit2->id, 'location' => $geom]);
        \App\Models\Observation::create(['species_id' => $sp2->id,'observationtime' => '2022-01-02 12:23:03','number' => 3,'visit_id' => $theVisit2->id, 'location' => $geom]);
        $sp4 = \App\Models\Species::where('nlname', 'boomblauwtje')->first();
        \App\Models\Observation::create(['species_id' => $sp4->id,'observationtime' => '2022-01-02 12:23:03','number' => 3,'visit_id' => $theVisit2->id, 'location' => $geom]);


        \App\Models\Visit::create(['countingmethod_id' => $fitCom->id,'startdate' => '2022-01-02 12:01:03','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','region_id' => '1','flower_id' => '1','method_id' => $method->id, 'location' => $geom]);
        \App\Models\Visit::create(['countingmethod_id' => $transectCom->id,'startdate' => '2022-01-02 12:01:03','enddate' => '2022-01-02 13:00:00','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','wind' => '1','temperature' => '23','cloud' => '3','transect_id' => '1','region_id' => '1','method_id' => $method->id, 'location' => $geom]);
        \App\Models\Visit::create(['countingmethod_id' => $timedCom->id,'startdate' => '2022-01-02 12:01:03','enddate' => '2022-01-02 13:00:00','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','wind' => '1','temperature' => '23','cloud' => '3','region_id' => '1','method_id' => $method->id, 'location' => $geom]);


        $pushMessage = \App\Models\PushMessage::create(['region_id' => $region->id, 'content' => "Test message content", 'header' => 'testMessage header', 'image_primary' => '', 'image_secondary'=> '']);
        \App\Models\UsersPushMessage::create(['pushmessage_id' => $pushMessage->id, 'user_id' => $user->id]);
    }
}
