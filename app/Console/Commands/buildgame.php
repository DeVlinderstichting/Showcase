<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class buildgame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buildgame';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $landscapeGrassland = \App\Models\Landscape::where('name', 'Grassland')->first();
        if ($landscapeGrassland == null)
        {
            $landscapeGrassland = new \App\Models\Landscape();
        }
        $landscapeGrassland->name = "Grassland"; 
        $landscapeGrassland->description = "A grassland with high intensity agriculture, it has only 1 dominant grass species and 4 insect species can be found here";
        $landscapeGrassland->save();

        $landscapeMidGrassland = \App\Models\Landscape::where('name', 'Flowerrich grassland')->first();
        if ($landscapeMidGrassland == null)
        {
            $landscapeMidGrassland = new \App\Models\Landscape();
        }
        $landscapeMidGrassland = new \App\Models\Landscape();
        $landscapeMidGrassland->name = "Flowerrich grassland"; 
        $landscapeMidGrassland->description = "A grassland with agricultural use, it is dominanted by grass, by several herbs can also grow here. About 15 insect species can be found here";
        $landscapeMidGrassland->save();

        $landscapeHighGrassland = \App\Models\Landscape::where('name', 'Natural grassland')->first();
        if ($landscapeHighGrassland == null)
        {
            $landscapeHighGrassland = new \App\Models\Landscape();
        }
        $landscapeHighGrassland = new \App\Models\Landscape();
        $landscapeHighGrassland->name = "Natural grassland"; 
        $landscapeHighGrassland->description = "A grassland with low intensity grazing, it is a mix of grass and herbs. There is a lot of small scale variation, hence many different niches are availble. About 85 insect species can be found here";
        $landscapeHighGrassland->save();


        $allLc = \App\Models\LandscapeComponent::all();
        foreach($allLc as $lc)
        {
            $lc->forceDelete();
        }

        $lsGrassComp = new \App\Models\LandscapeComponent();
        $lsGrassComp->landscape_id = $landscapeGrassland->id;
        $lsGrassComp->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(1 1, 1 6, 6 6, 6 1, 1 1)') where id = $lsGrassComp->id"));
        $lsGrassComp2 = new \App\Models\LandscapeComponent();
        $lsGrassComp2->landscape_id = $landscapeGrassland->id;
        $lsGrassComp2->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(1 6, 1 11, 6 11, 6 6, 1 6)') where id = $lsGrassComp2->id"));
        $lsGrassComp3 = new \App\Models\LandscapeComponent();
        $lsGrassComp3->landscape_id = $landscapeGrassland->id;
        $lsGrassComp3->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(6 1, 6 6, 11 6, 11 1, 6 1)') where id = $lsGrassComp3->id"));
        $lsGrassComp4 = new \App\Models\LandscapeComponent();
        $lsGrassComp4->landscape_id = $landscapeGrassland->id;
        $lsGrassComp4->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(6 6, 6 11, 11 11, 11 6, 6 6)') where id = $lsGrassComp4->id"));


        $lsMidGrassComp = new \App\Models\LandscapeComponent();
        $lsMidGrassComp->landscape_id = $landscapeMidGrassland->id;
        $lsMidGrassComp->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(75 29,77 29,77.6 29.5, 75 29)') where id = $lsMidGrassComp->id"));

        $lsHighGrassComp = new \App\Models\LandscapeComponent();
        $lsHighGrassComp->landscape_id = $landscapeHighGrassland->id;
        $lsHighGrassComp->save();
        DB::statement(DB::raw("UPDATE landscapecomponents set shape = ST_MakePolygon( 'LINESTRING(75 29,77 29,77.6 29.5, 75 29)') where id = $lsHighGrassComp->id"));
        //$table->GEOMETRY('shape')->nullable();
        //$table->GEOMETRY('position')->nullable();
        //$table->text('texturelocation')->nullable();
        //$table->text('element')->nullable();
        //$table->double('frequency', 12,4)->default(0);
        //$table->double('ecoscore', 8,2)->default(0);

//         $location = \App\Location::create(['name'=> "tel-locatie", 'description' => "tel-locatie", 'epsg'=>4326, 'geom'=> "LINESTRING(3.4912091493606567 49.07987493185826,4.9853497743606585 53.57838516080423,-0.2880877256393485 53.78660081972285,2.1728497743606594 49.13741048075656,8.588865399360651 52.037861421896395)" ]);


        $allGa = \App\Models\GameAction::all();
        foreach($allGa as $ga)
        {
            $ga->forceDelete();
        }
        $allAe = \App\Models\GameActionEffect::all();
        foreach($allAe as $ae)
        {
            $ae->forceDelete();
        }

        $ga = new \App\Models\GameAction();
        $ga->name = "haymaking";
        $ga->description = "A management type focused on reducing nitrogen deposition and counteracting the effect of succession";
        $ga->save();
        $ae = new \App\Models\GameActionEffect();
        $ae->landscape_id = $landscapeGrassland->id;
        $ae->newlandscape_id = $landscapeMidGrassland->id;
        $ae->save();
    }
}
