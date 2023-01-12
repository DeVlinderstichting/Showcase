<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addSpeciesAndLanduseAndManagementTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loadExtraStuff';

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
        $beesSpeciesGroup = \App\Models\Speciesgroup::where('name', 'solitarybees')->first();

        $Amegi = \App\Models\Species::where('genus', 'Amegilla')->first(); if ($Amegi == null) {$Amegi= \App\Models\Species::create(['genus' => 'Amegilla', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Amegillaquadrifasciata = \App\Models\Species::where('genus', 'Amegilla')->where('taxon', 'quadrifasciata')->first(); if($Amegillaquadrifasciata==null){\App\Models\Species::create(['genus' => 'Amegilla', 'taxon' => 'quadrifasciata', 'parent_id' => $Amegi->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Andre = \App\Models\Species::where('genus', 'Andrena')->first(); if ($Andre == null) {$Andre= \App\Models\Species::create(['genus' => 'Andrena', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Andrena = \App\Models\Species::where('genus', 'Andrena')->where('taxon', '')->first(); if($Andrena==null){\App\Models\Species::create(['genus' => 'Andrena', 'taxon' => '', 'parent_id' => $Andre->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Andrenaflorea  = \App\Models\Species::where('genus', 'Andrena')->where('taxon', 'florea ')->first(); if($Andrenaflorea ==null){\App\Models\Species::create(['genus' => 'Andrena', 'taxon' => 'florea ', 'parent_id' => $Andre->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Anthi = \App\Models\Species::where('genus', 'Anthidium')->first(); if ($Anthi == null) {$Anthi= \App\Models\Species::create(['genus' => 'Anthidium', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Antho = \App\Models\Species::where('genus', 'Anthophora')->first(); if ($Antho == null) {$Antho= \App\Models\Species::create(['genus' => 'Anthophora', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Anthophoraplumipes = \App\Models\Species::where('genus', 'Anthophora')->where('taxon', 'plumipes')->first(); if($Anthophoraplumipes==null){\App\Models\Species::create(['genus' => 'Anthophora', 'taxon' => 'plumipes', 'parent_id' => $Antho->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Bombu = \App\Models\Species::where('genus', 'Bombus')->first(); if ($Bombu == null) {$Bombu= \App\Models\Species::create(['genus' => 'Bombus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Bombus = \App\Models\Species::where('genus', 'Bombus')->where('taxon', '')->first(); if($Bombus==null){\App\Models\Species::create(['genus' => 'Bombus', 'taxon' => '', 'parent_id' => $Bombu->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Bombusterrestris = \App\Models\Species::where('genus', 'Bombus')->where('taxon', 'terrestris')->first(); if($Bombusterrestris==null){\App\Models\Species::create(['genus' => 'Bombus', 'taxon' => 'terrestris', 'parent_id' => $Bombu->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Cerat = \App\Models\Species::where('genus', 'Ceratina')->first(); if ($Cerat == null) {$Cerat= \App\Models\Species::create(['genus' => 'Ceratina', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Ceratinacucurbitina  = \App\Models\Species::where('genus', 'Ceratina')->where('taxon', 'cucurbitina ')->first(); if($Ceratinacucurbitina ==null){\App\Models\Species::create(['genus' => 'Ceratina', 'taxon' => 'cucurbitina ', 'parent_id' => $Cerat->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Coeli = \App\Models\Species::where('genus', 'Coelioxis')->first(); if ($Coeli == null) {$Coeli= \App\Models\Species::create(['genus' => 'Coelioxis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Colle = \App\Models\Species::where('genus', 'Colletes')->first(); if ($Colle == null) {$Colle= \App\Models\Species::create(['genus' => 'Colletes', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Colleteshederae = \App\Models\Species::where('genus', 'Colletes')->where('taxon', 'hederae')->first(); if($Colleteshederae==null){\App\Models\Species::create(['genus' => 'Colletes', 'taxon' => 'hederae', 'parent_id' => $Colle->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Dasyp = \App\Models\Species::where('genus', 'Dasypoda')->first(); if ($Dasyp == null) {$Dasyp= \App\Models\Species::create(['genus' => 'Dasypoda', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Eucer = \App\Models\Species::where('genus', 'Eucera')->first(); if ($Eucer == null) {$Eucer= \App\Models\Species::create(['genus' => 'Eucera', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Euceranigrilabris = \App\Models\Species::where('genus', 'Eucera')->where('taxon', 'nigrilabris')->first(); if($Euceranigrilabris==null){\App\Models\Species::create(['genus' => 'Eucera', 'taxon' => 'nigrilabris', 'parent_id' => $Eucer->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Halic = \App\Models\Species::where('genus', 'Halictus')->first(); if ($Halic == null) {$Halic= \App\Models\Species::create(['genus' => 'Halictus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Halictusscabiosae = \App\Models\Species::where('genus', 'Halictus')->where('taxon', 'scabiosae')->first(); if($Halictusscabiosae==null){\App\Models\Species::create(['genus' => 'Halictus', 'taxon' => 'scabiosae', 'parent_id' => $Halic->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Hopli = \App\Models\Species::where('genus', 'Hoplitis')->first(); if ($Hopli == null) {$Hopli= \App\Models\Species::create(['genus' => 'Hoplitis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Hylae = \App\Models\Species::where('genus', 'Hylaeus')->first(); if ($Hylae == null) {$Hylae= \App\Models\Species::create(['genus' => 'Hylaeus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Hylaeusvariegatus = \App\Models\Species::where('genus', 'Hylaeus')->where('taxon', 'variegatus')->first(); if($Hylaeusvariegatus==null){\App\Models\Species::create(['genus' => 'Hylaeus', 'taxon' => 'variegatus', 'parent_id' => $Hylae->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Lasio = \App\Models\Species::where('genus', 'Lasioglossum')->first(); if ($Lasio == null) {$Lasio= \App\Models\Species::create(['genus' => 'Lasioglossum', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Megac = \App\Models\Species::where('genus', 'Megachile')->first(); if ($Megac == null) {$Megac= \App\Models\Species::create(['genus' => 'Megachile', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Megachilecentuncularis = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'centuncularis')->first(); if($Megachilecentuncularis==null){\App\Models\Species::create(['genus' => 'Megachile', 'taxon' => 'centuncularis', 'parent_id' => $Megac->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Megachile = \App\Models\Species::where('genus', 'Megachile')->where('taxon', '')->first(); if($Megachile==null){\App\Models\Species::create(['genus' => 'Megachile', 'taxon' => '', 'parent_id' => $Megac->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Megachilewillughbiella = \App\Models\Species::where('genus', 'Megachile')->where('taxon', 'willughbiella')->first(); if($Megachilewillughbiella==null){\App\Models\Species::create(['genus' => 'Megachile', 'taxon' => 'willughbiella', 'parent_id' => $Megac->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Melec = \App\Models\Species::where('genus', 'Melecta')->first(); if ($Melec == null) {$Melec= \App\Models\Species::create(['genus' => 'Melecta', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Melectaalbifrons = \App\Models\Species::where('genus', 'Melecta')->where('taxon', 'albifrons')->first(); if($Melectaalbifrons==null){\App\Models\Species::create(['genus' => 'Melecta', 'taxon' => 'albifrons', 'parent_id' => $Melec->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Nomad = \App\Models\Species::where('genus', 'Nomada')->first(); if ($Nomad == null) {$Nomad= \App\Models\Species::create(['genus' => 'Nomada', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Nomadaagrestis = \App\Models\Species::where('genus', 'Nomada')->where('taxon', 'agrestis')->first(); if($Nomadaagrestis==null){\App\Models\Species::create(['genus' => 'Nomada', 'taxon' => 'agrestis', 'parent_id' => $Nomad->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Nomia = \App\Models\Species::where('genus', 'Nomiapis')->first(); if ($Nomia == null) {$Nomia= \App\Models\Species::create(['genus' => 'Nomiapis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Osmia = \App\Models\Species::where('genus', 'Osmia')->first(); if ($Osmia == null) {$Osmia= \App\Models\Species::create(['genus' => 'Osmia', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Panur = \App\Models\Species::where('genus', 'Panurgus')->first(); if ($Panur == null) {$Panur= \App\Models\Species::create(['genus' => 'Panurgus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Panurguscalcaratus = \App\Models\Species::where('genus', 'Panurgus')->where('taxon', 'calcaratus')->first(); if($Panurguscalcaratus==null){\App\Models\Species::create(['genus' => 'Panurgus', 'taxon' => 'calcaratus', 'parent_id' => $Panur->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Rhoda = \App\Models\Species::where('genus', 'Rhodanthidium')->first(); if ($Rhoda == null) {$Rhoda= \App\Models\Species::create(['genus' => 'Rhodanthidium', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Sphec = \App\Models\Species::where('genus', 'Sphecodes')->first(); if ($Sphec == null) {$Sphec= \App\Models\Species::create(['genus' => 'Sphecodes', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Thyre = \App\Models\Species::where('genus', 'Thyreus')->first(); if ($Thyre == null) {$Thyre= \App\Models\Species::create(['genus' => 'Thyreus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Xyloc = \App\Models\Species::where('genus', 'Xylocopa')->first(); if ($Xyloc == null) {$Xyloc= \App\Models\Species::create(['genus' => 'Xylocopa', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'speciesgroup', 'diurnal' => false]);}
        $Xylocopa = \App\Models\Species::where('genus', 'Xylocopa')->where('taxon', '')->first(); if($Xylocopa==null){\App\Models\Species::create(['genus' => 'Xylocopa', 'taxon' => '', 'parent_id' => $Xyloc->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Xylocopaviolacea = \App\Models\Species::where('genus', 'Xylocopa')->where('taxon', 'violacea')->first(); if($Xylocopaviolacea==null){\App\Models\Species::create(['genus' => 'Xylocopa', 'taxon' => 'violacea', 'parent_id' => $Xyloc->id , 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        

        $Amegi = \App\Models\Species::where('genus', 'Amegilla')->where('taxrank', 'species')->first(); if ($Amegi == null) {$Amegi= \App\Models\Species::create(['genus' => 'Amegilla', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Andre = \App\Models\Species::where('genus', 'Andrena')->where('taxrank', 'species')->first(); if ($Andre == null) {$Andre= \App\Models\Species::create(['genus' => 'Andrena', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Anthi = \App\Models\Species::where('genus', 'Anthidium')->where('taxrank', 'species')->first(); if ($Anthi == null) {$Anthi= \App\Models\Species::create(['genus' => 'Anthidium', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Antho = \App\Models\Species::where('genus', 'Anthophora')->where('taxrank', 'species')->first(); if ($Antho == null) {$Antho= \App\Models\Species::create(['genus' => 'Anthophora', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Bombu = \App\Models\Species::where('genus', 'Bombus')->where('taxrank', 'species')->first(); if ($Bombu == null) {$Bombu= \App\Models\Species::create(['genus' => 'Bombus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Cerat = \App\Models\Species::where('genus', 'Ceratina')->where('taxrank', 'species')->first(); if ($Cerat == null) {$Cerat= \App\Models\Species::create(['genus' => 'Ceratina', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Coeli = \App\Models\Species::where('genus', 'Coelioxis')->where('taxrank', 'species')->first(); if ($Coeli == null) {$Coeli= \App\Models\Species::create(['genus' => 'Coelioxis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Colle = \App\Models\Species::where('genus', 'Colletes')->where('taxrank', 'species')->first(); if ($Colle == null) {$Colle= \App\Models\Species::create(['genus' => 'Colletes', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Dasyp = \App\Models\Species::where('genus', 'Dasypoda')->where('taxrank', 'species')->first(); if ($Dasyp == null) {$Dasyp= \App\Models\Species::create(['genus' => 'Dasypoda', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Eucer = \App\Models\Species::where('genus', 'Eucera')->where('taxrank', 'species')->first(); if ($Eucer == null) {$Eucer= \App\Models\Species::create(['genus' => 'Eucera', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Halic = \App\Models\Species::where('genus', 'Halictus')->where('taxrank', 'species')->first(); if ($Halic == null) {$Halic= \App\Models\Species::create(['genus' => 'Halictus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Hopli = \App\Models\Species::where('genus', 'Hoplitis')->where('taxrank', 'species')->first(); if ($Hopli == null) {$Hopli= \App\Models\Species::create(['genus' => 'Hoplitis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Hylae = \App\Models\Species::where('genus', 'Hylaeus')->where('taxrank', 'species')->first(); if ($Hylae == null) {$Hylae= \App\Models\Species::create(['genus' => 'Hylaeus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Lasio = \App\Models\Species::where('genus', 'Lasioglossum')->where('taxrank', 'species')->first(); if ($Lasio == null) {$Lasio= \App\Models\Species::create(['genus' => 'Lasioglossum', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Megac = \App\Models\Species::where('genus', 'Megachile')->where('taxrank', 'species')->first(); if ($Megac == null) {$Megac= \App\Models\Species::create(['genus' => 'Megachile', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Melec = \App\Models\Species::where('genus', 'Melecta')->where('taxrank', 'species')->first(); if ($Melec == null) {$Melec= \App\Models\Species::create(['genus' => 'Melecta', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Nomad = \App\Models\Species::where('genus', 'Nomada')->where('taxrank', 'species')->first(); if ($Nomad == null) {$Nomad= \App\Models\Species::create(['genus' => 'Nomada', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Nomia = \App\Models\Species::where('genus', 'Nomiapis')->where('taxrank', 'species')->first(); if ($Nomia == null) {$Nomia= \App\Models\Species::create(['genus' => 'Nomiapis', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Osmia = \App\Models\Species::where('genus', 'Osmia')->where('taxrank', 'species')->first(); if ($Osmia == null) {$Osmia= \App\Models\Species::create(['genus' => 'Osmia', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Panur = \App\Models\Species::where('genus', 'Panurgus')->where('taxrank', 'species')->first(); if ($Panur == null) {$Panur= \App\Models\Species::create(['genus' => 'Panurgus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Rhoda = \App\Models\Species::where('genus', 'Rhodanthidium')->where('taxrank', 'species')->first(); if ($Rhoda == null) {$Rhoda= \App\Models\Species::create(['genus' => 'Rhodanthidium', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Sphec = \App\Models\Species::where('genus', 'Sphecodes')->where('taxrank', 'species')->first(); if ($Sphec == null) {$Sphec= \App\Models\Species::create(['genus' => 'Sphecodes', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Thyre = \App\Models\Species::where('genus', 'Thyreus')->where('taxrank', 'species')->first(); if ($Thyre == null) {$Thyre= \App\Models\Species::create(['genus' => 'Thyreus', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}
        $Xyloc = \App\Models\Species::where('genus', 'Xylocopa')->where('taxrank', 'species')->first(); if ($Xyloc == null) {$Xyloc= \App\Models\Species::create(['genus' => 'Xylocopa', 'speciesgroup_id' => $beesSpeciesGroup->id, 'taxrank' => 'species', 'diurnal' => false]);}


        print("bee species loaded\n");


        $mtefr = \App\Models\ManagementType::where('name', 'managementtype_enhancedflowerresources')->first();
        if ($mtefr == null)
        {
            \App\Models\ManagementType::create(['name' => 'managementtype_enhancedflowerresources', 'description'=> 'Enhanced flower resources']);
        }
        $mtehm = \App\Models\ManagementType::where('name', 'managementtype_enhancedflowerresources')->first();
        if ($mtehm == null)
        {
            \App\Models\ManagementType::create(['name' => 'managementtype_enhancedhabitatmanagement', 'description'=> 'Enhanced habitat management']);
        }
        $mtenr = \App\Models\ManagementType::where('name', 'managementtype_enhancedflowerresources')->first();
        if ($mtenr == null)
        {
            \App\Models\ManagementType::create(['name' => 'managementtype_enhancednestingresources', 'description'=> 'Enhanced nesting resources']);
        }
        print("new management types loaded\n");


        $lutn = \App\Models\LanduseType::where('name', 'landusetype_natural')->first();
        if ($lutn == null)
        {
            \App\Models\LanduseType::create(['name' => 'landusetype_natural', 'description'=> 'Natural']);
        }
        $lutf = \App\Models\LanduseType::where('name', 'landusetype_forest')->first();
        if ($lutf == null)
        {
            \App\Models\LanduseType::create(['name' => 'landusetype_forest', 'description'=> 'Forest']);
        }
        $lutam = \App\Models\LanduseType::where('name', 'landusetype_agriculturalmatrix')->first();
        if ($lutam == null)
        {
            \App\Models\LanduseType::create(['name' => 'landusetype_agriculturalmatrix', 'description'=> 'Agricultural matrix']);
        }
        print("new landuse types loaded\n");


    }
}
