<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class update221213 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update221213';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '2022-12-13: Add bee species, landuse and management types to the database.';

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
        // Grassland
        $lt = \App\Models\LanduseType::where('name', 'landusetype_grassland')->first();
        if ($lt == null)
        {
            $lt = new \App\Models\LanduseType(); 
            $lt->name = "landusetype_grassland";
            $lt->description = "Grassland";
            $lt->save();
        }
        $l = \App\Models\Language::where('key', $lt->name)->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = $lt->name;
            $l->en = $lt->description;
            $l->nl = "Grasland";
            $l->save();
        }

        // Urban area
        $lt = \App\Models\LanduseType::where('name', 'landusetype_urbanArea')->first();
        if ($lt == null)
        {
            $lt = new \App\Models\LanduseType(); 
            $lt->name = "landusetype_urbanArea";
            $lt->description = "Urban area";
            $lt->save();
        }
        $l = \App\Models\Language::where('key', $lt->name)->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = $lt->name;
            $l->en = $lt->description;
            $l->nl = "Stedelijk gebied";
            $l->save();
        }

        // Bee hotel
        $mt = \App\Models\ManagementType::where('name', 'managementtype_beeHotel')->first();
        if ($mt == null)
        {
            $mt = new \App\Models\ManagementType(); 
            $mt->name = "managementtype_beeHotel";
            $mt->description = "Bee hotel";
            $mt->save();
        }
        $l = \App\Models\Language::where('key', $mt->name)->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = $mt->name;
            $l->en = $mt->description;
            $l->nl = "Bijenhotel";
            $l->save();
        }

        // Control
        $mt = \App\Models\ManagementType::where('name', 'managementtype_control')->first();
        if ($mt == null)
        {
            $mt = new \App\Models\ManagementType(); 
            $mt->name = "managementtype_control";
            $mt->description = "Control (no management)";
            $mt->save();
        }
        $l = \App\Models\Language::where('key', $mt->name)->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = $mt->name;
            $l->en = $mt->description;
            $l->nl = "Controle (geen beheer)";
            $l->save();
        }

        // Bumble bee species
        $bb_spg_id = \App\Models\Speciesgroup::where('name', 'bumblebees')->first()->id;
        $s = \App\Models\Species::where('genus', 'Bombus')->where('taxon', 'cf. pascuorum')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Bombus';
            $s->taxon = 'cf. pascuorum';
            $s->speciesgroup_id = $bb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Bombus')->where('taxon', 'cf. terrestris')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Bombus';
            $s->taxon = 'cf. terrestris';
            $s->speciesgroup_id = $bb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Bombus')->where('taxon', 'other species')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Bombus';
            $s->taxon = 'other species';
            $s->speciesgroup_id = $bb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }


        // Solitary bee species
        $sb_spg_id = \App\Models\Speciesgroup::where('name', 'solitarybees')->first()->id;
        $s = \App\Models\Species::where('genus', 'Amegilla')->where('taxon', 'quadrifasciata')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Amegilla';
            $s->taxon = 'quadrifasciata';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Amegilla')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Amegilla';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Andrena')->where('taxon', 'agilissima')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Andrena';
            $s->taxon = 'agilissima';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Andrena')->where('taxon', 'florea')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Andrena';
            $s->taxon = 'florea';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Andrena')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Andrena';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Anthidium')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Anthidium';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Anthophora')->where('taxon', 'plumipes')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Anthophora';
            $s->taxon = 'plumipes';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Anthophora')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Anthophora';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Ceratina')->where('taxon', 'cucurbitina')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Ceratina';
            $s->taxon = 'cucurbitina';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Ceratina')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Ceratina';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Coelioxis')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Coelioxis';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Colletes')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Colletes';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Colletes')->where('taxon', 'hederae')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Colletes';
            $s->taxon = 'hederae';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Dasypoda')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Dasypoda';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Eucera')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Eucera';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Eucera')->where('taxon', 'nigrilabris')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Eucera';
            $s->taxon = 'nigrilabris';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Halictus')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Halictus';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Halictus')->where('taxon', 'scabiosae')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Halictus';
            $s->taxon = 'scabiosae';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Hoplitis')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Hoplitis';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Hylaeus')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Hylaeus';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Hylaeus')->where('taxon', 'variegatus')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Hylaeus';
            $s->taxon = 'variegatus';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Lasioglossum')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Lasioglossum';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'centuncularis')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Megachile';
            $s->taxon = 'centuncularis';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'sculpturalis')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Megachile';
            $s->taxon = 'sculpturalis';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Megachile';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'willughbiella')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Megachile';
            $s->taxon = 'willughbiella';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Melecta')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Melecta';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Melecta')->where('taxon', 'albifrons')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Melecta';
            $s->taxon = 'albifrons';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Nomada')->where('taxon', 'agrestis')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Nomada';
            $s->taxon = 'agrestis';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Nomada')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Nomada';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Osmia')->where('taxon', 'cf. cornuta')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Osmia';
            $s->taxon = 'cf. cornuta';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Nomiapis')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Nomiapis';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Panurgus')->where('taxon', 'calcaratus')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Panurgus';
            $s->taxon = 'calcaratus';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Panurgus')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Panurgus';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Sphecodes')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Sphecodes';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Rhodanthidium')->where('taxon', 'sticticum')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Rhodanthidium';
            $s->taxon = 'sticticum';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Thyreus')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Thyreus';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Xylocopa')->where('taxon', 'cantabrita')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Xylocopa';
            $s->taxon = 'cantabrita';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Xylocopa')->where('taxon', 'cf. violacea')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Xylocopa';
            $s->taxon = 'cf. violacea';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
        $s = \App\Models\Species::where('genus', 'Xylocopa')->where('taxon', 'sp.')->first();
        if ($s == null)
        {
            $s = new \App\Models\Species(); 
            $s->genus = 'Xylocopa';
            $s->taxon = 'sp.';
            $s->speciesgroup_id = $sb_spg_id;
            $s->taxrank = 'species';
            $s->save();
        }
    }
}
