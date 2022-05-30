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

        $rawGeom = '{ "type":"Point","coordinates":[6.23188379999999,52.2457984]}';
        $geom = \DB::raw("ST_GeomFromGeoJSON('".$rawGeom."')");

        $tr = \App\Models\Transect::create(['name' => 'testTransect']);
        \App\Models\TransectSections::create(['name' => 't1', 'transect_id' => $tr->id, 'sequence' => '1', 'location' => $geom]);
        \App\Models\TransectSections::create(['name' => 't2', 'transect_id' => $tr->id, 'sequence' => '2', 'location' => $geom]);
        \App\Models\TransectSections::create(['name' => 't3', 'transect_id' => $tr->id, 'sequence' => '3', 'location' => $geom]);        
        $tr2 = \App\Models\Transect::create(['name' => 'testTransect2']);
        
        \App\Models\TransectSections::create(['name' => 'a1', 'transect_id' => $tr2->id, 'sequence' => '1', 'location' => $geom]);
        \App\Models\TransectSections::create(['name' => 'b2', 'transect_id' => $tr2->id, 'sequence' => '2', 'location' => $geom]);
        \App\Models\TransectSections::create(['name' => 'c3', 'transect_id' => $tr2->id, 'sequence' => '3', 'location' => $geom]);        
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


        \App\Models\Visit::create(['countingmethod_id' => $fitCom->id,'startdate' => '2022-01-02 12:01:03', 'enddate' => '2022-01-02 12:16:03','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','region_id' => '1','flower_id' => '1','method_id' => $method->id, 'location' => $geom]);
        \App\Models\Visit::create(['countingmethod_id' => $transectCom->id,'startdate' => '2022-01-02 12:01:03','enddate' => '2022-01-02 13:00:00','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','wind' => '1','temperature' => '23','cloud' => '3','transect_id' => '1','region_id' => '1','method_id' => $method->id, 'location' => $geom]);
        \App\Models\Visit::create(['countingmethod_id' => $timedCom->id,'startdate' => '2022-01-02 12:01:03','enddate' => '2022-01-02 13:00:00','status' => '2','user_id' => $user->id,'recorders' => 1,'notes' => 'I have only noted that there is nothing to note','wind' => '1','temperature' => '23','cloud' => '3','region_id' => '1','method_id' => $method->id, 'location' => $geom]);


        $pushMessage = \App\Models\PushMessage::create(['region_id' => $region->id, 'content' => "Test message content", 'header' => 'testMessage header', 'image_primary' => 'images/bf1.jpg', 'image_secondary'=> 'images/bf2.jpg']);
        $pushMessage2 = \App\Models\PushMessage::create(['region_id' => $region->id, 'content' => "Test message content2", 'header' => 'testMessage header', 'image_primary' => 'images/bf3.jpg', 'image_secondary'=> 'images/bf4.jpg']);
        \App\Models\UsersPushMessage::create(['pushmessage_id' => $pushMessage->id, 'user_id' => $user->id]);
        \App\Models\UsersPushMessage::create(['pushmessage_id' => $pushMessage2->id, 'user_id' => $user->id]);

        \App\Models\NewsItem::create(
            [
                'title' => 'News item 1',
                'introduction' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'maintext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque lacinia fermentum. Ut eget risus quam. Curabitur ut est ut nibh accumsan egestas. Nunc maximus sit amet velit nec faucibus. Praesent blandit orci suscipit, vehicula enim eget, tincidunt nibh. Ut ut odio interdum, accumsan turpis eget, sollicitudin ipsum. Phasellus vitae faucibus risus. Vivamus bibendum nulla orci, nec suscipit ligula aliquet sed. In ut quam nibh. Praesent tincidunt blandit sapien non ultrices. Curabitur id tellus vel libero finibus bibendum et in nibh. Morbi venenatis sem sapien, et vestibulum mauris ullamcorper sit amet. Nam lorem tellus, scelerisque nec facilisis eget, rhoncus dictum odio. Duis blandit lacus sollicitudin lacinia pellentesque. Aliquam erat volutpat.
                
                Nam lobortis lacus vitae odio pretium hendrerit. Aliquam euismod turpis ipsum, a auctor ante lacinia quis. Pellentesque blandit lectus neque, in ullamcorper leo lobortis sit amet. Nunc molestie dolor non pharetra ullamcorper. Quisque at vehicula diam. Sed iaculis congue consectetur. Nullam eu nisi luctus, lacinia ex sed, ullamcorper sem. Nunc lobortis consequat velit, vitae commodo felis suscipit ut. Quisque mollis pretium dolor, eget rutrum justo interdum sit amet. Quisque vel quam tristique purus tincidunt consequat vel at odio. Fusce sagittis convallis ante et venenatis. Maecenas id arcu sed est tristique elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eu faucibus leo, a tempus risus. Curabitur pharetra arcu quis nibh rhoncus laoreet. Sed ultricies leo nec ex consequat vehicula.
                
                Quisque molestie tortor in turpis ultrices sodales a nec tortor. Donec vitae justo faucibus, ornare nibh in, varius sapien. Aliquam metus justo, sodales at aliquam non, placerat at purus. Praesent consectetur, lectus auctor egestas tempus, nisl quam dapibus mi, posuere pulvinar nisl lorem nec velit. In eget elit sed tellus vulputate ultricies in vitae nisi. Sed vel tristique ligula. Donec rutrum pulvinar diam vel dapibus. Donec vestibulum neque a ultrices condimentum. Donec pharetra nisl tortor. Aenean auctor, sem sit amet imperdiet volutpat, leo erat faucibus diam, sit amet lobortis leo diam at orci. Vestibulum quis felis urna.
                
                Vestibulum interdum elit eu commodo vestibulum. Morbi metus ipsum, malesuada quis enim a, interdum bibendum ex. Nam posuere fringilla pulvinar. In id turpis nisi. Praesent dictum vulputate arcu, ac rhoncus sem facilisis ut. Duis vehicula varius erat sed ultricies. Morbi ut libero vitae urna aliquet mattis quis eu orci. Suspendisse suscipit mi et commodo pellentesque. Nullam blandit, orci pellentesque condimentum feugiat, quam ipsum tempus risus, vitae suscipit tellus turpis a ex. Vivamus gravida condimentum nulla ullamcorper pulvinar. Proin nisl ex, pretium accumsan cursus in, viverra vel dolor. Proin sodales neque at ligula finibus, eget accumsan tortor porta. Maecenas in magna vel lectus malesuada tempor. Nulla eget nisi sapien. Donec mollis metus quis ex lobortis, non ornare nunc semper. Quisque scelerisque id dolor nec tincidunt.
                
                Integer pulvinar posuere dui blandit maximus. Integer posuere, ex vel convallis hendrerit, erat velit maximus nisl, eu ornare ante ipsum id nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus sagittis ligula a est ullamcorper scelerisque. In hac habitasse platea dictumst. Ut ac nisl non lacus placerat malesuada. In rhoncus fermentum tortor, ac rutrum augue congue sit amet. Nunc id tempus ipsum, vitae ultricies dui. ',
                'moreinfo' => 'https://www.lipsum.com/'

            ]
            );
        \App\Models\NewsItem::create(
                [
                    'title' => 'News item 2',
                    'introduction' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    'maintext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque lacinia fermentum. Ut eget risus quam. Curabitur ut est ut nibh accumsan egestas. Nunc maximus sit amet velit nec faucibus. Praesent blandit orci suscipit, vehicula enim eget, tincidunt nibh. Ut ut odio interdum, accumsan turpis eget, sollicitudin ipsum. Phasellus vitae faucibus risus. Vivamus bibendum nulla orci, nec suscipit ligula aliquet sed. In ut quam nibh. Praesent tincidunt blandit sapien non ultrices. Curabitur id tellus vel libero finibus bibendum et in nibh. Morbi venenatis sem sapien, et vestibulum mauris ullamcorper sit amet. Nam lorem tellus, scelerisque nec facilisis eget, rhoncus dictum odio. Duis blandit lacus sollicitudin lacinia pellentesque. Aliquam erat volutpat.
                    
                    Nam lobortis lacus vitae odio pretium hendrerit. Aliquam euismod turpis ipsum, a auctor ante lacinia quis. Pellentesque blandit lectus neque, in ullamcorper leo lobortis sit amet. Nunc molestie dolor non pharetra ullamcorper. Quisque at vehicula diam. Sed iaculis congue consectetur. Nullam eu nisi luctus, lacinia ex sed, ullamcorper sem. Nunc lobortis consequat velit, vitae commodo felis suscipit ut. Quisque mollis pretium dolor, eget rutrum justo interdum sit amet. Quisque vel quam tristique purus tincidunt consequat vel at odio. Fusce sagittis convallis ante et venenatis. Maecenas id arcu sed est tristique elementum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eu faucibus leo, a tempus risus. Curabitur pharetra arcu quis nibh rhoncus laoreet. Sed ultricies leo nec ex consequat vehicula.
                    
                    Quisque molestie tortor in turpis ultrices sodales a nec tortor. Donec vitae justo faucibus, ornare nibh in, varius sapien. Aliquam metus justo, sodales at aliquam non, placerat at purus. Praesent consectetur, lectus auctor egestas tempus, nisl quam dapibus mi, posuere pulvinar nisl lorem nec velit. In eget elit sed tellus vulputate ultricies in vitae nisi. Sed vel tristique ligula. Donec rutrum pulvinar diam vel dapibus. Donec vestibulum neque a ultrices condimentum. Donec pharetra nisl tortor. Aenean auctor, sem sit amet imperdiet volutpat, leo erat faucibus diam, sit amet lobortis leo diam at orci. Vestibulum quis felis urna.
                    
                    Vestibulum interdum elit eu commodo vestibulum. Morbi metus ipsum, malesuada quis enim a, interdum bibendum ex. Nam posuere fringilla pulvinar. In id turpis nisi. Praesent dictum vulputate arcu, ac rhoncus sem facilisis ut. Duis vehicula varius erat sed ultricies. Morbi ut libero vitae urna aliquet mattis quis eu orci. Suspendisse suscipit mi et commodo pellentesque. Nullam blandit, orci pellentesque condimentum feugiat, quam ipsum tempus risus, vitae suscipit tellus turpis a ex. Vivamus gravida condimentum nulla ullamcorper pulvinar. Proin nisl ex, pretium accumsan cursus in, viverra vel dolor. Proin sodales neque at ligula finibus, eget accumsan tortor porta. Maecenas in magna vel lectus malesuada tempor. Nulla eget nisi sapien. Donec mollis metus quis ex lobortis, non ornare nunc semper. Quisque scelerisque id dolor nec tincidunt.
                    
                    Integer pulvinar posuere dui blandit maximus. Integer posuere, ex vel convallis hendrerit, erat velit maximus nisl, eu ornare ante ipsum id nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus sagittis ligula a est ullamcorper scelerisque. In hac habitasse platea dictumst. Ut ac nisl non lacus placerat malesuada. In rhoncus fermentum tortor, ac rutrum augue congue sit amet. Nunc id tempus ipsum, vitae ultricies dui. ',
                    'moreinfo' => 'https://www.lipsum.com/'
    
                ]
                );
    }
}
