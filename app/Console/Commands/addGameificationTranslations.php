<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addGameificationTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addGameificationTranslations';

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
        $l = \App\Models\Language::where('key', 'badgesHeader')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgesHeader";
            $l->en = "Badges";
            $l->nl = "Badges";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'badgeSpeciesCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountDescription";
            $l->en = "Number of species seen";
            $l->nl = "Aantal soorten gezien";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'badgeSpeciesCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountlvl1Description";
            $l->en = "Bronze species badge";
            $l->nl = "Bronzen soorten badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountlvl2Description";
            $l->en = "Silver species badge";
            $l->nl = "Zilveren soorten badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountlvl3Description";
            $l->en = "Golden species badge";
            $l->nl = "Gouden soorten badge";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'badgeSpeciesCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountLvl1RequirementDescription";
            $l->en = "10 species seen";
            $l->nl = "10 soorten gezien";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountLvl2RequirementDescription";
            $l->en = "25 species seen";
            $l->nl = "25 soorten gezien";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesCountLvl3RequirementDescription";
            $l->en = "50 species seen";
            $l->nl = "50 soorten gezien";
            $l->save();
        }




        $l = \App\Models\Language::where('key', 'badgeVisitCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountTitle";
            $l->en = "Number of visits";
            $l->nl = "Aantal keer geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountDescription";
            $l->en = "Number of visits";
            $l->nl = "Aantal keer geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountlvl1Description";
            $l->en = "Bronze visit badge";
            $l->nl = "Bronzen tellingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountlvl2Description";
            $l->en = "Silver visit badge";
            $l->nl = "Zilveren tellingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountlvl3Description";
            $l->en = "Gold visit badge";
            $l->nl = "Gouden tellingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeVisitCountLvl1RequirementDescription";
            $l->en = "5 visits";
            $l->nl = "5 keer geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeVisitCountLvl2RequirementDescription";
            $l->en = "10 visits";
            $l->nl = "10 keer geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeVisitCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeVisitCountLvl3RequirementDescription";
            $l->en = "25 visits";
            $l->nl = "25 keer geteld";
            $l->save();
        }



        $l = \App\Models\Language::where('key', 'badgeTechniqueCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountTitle";
            $l->en = "Number of recording methods";
            $l->nl = "Data verzamel technieken";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountDescription";
            $l->en = "Number of recordingtypes";
            $l->nl = "Data verzamel technieken";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountlvl1Description";
            $l->en = "Bronze recording methode badge";
            $l->nl = "Bronzen teltechnieken badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountlvl2Description";
            $l->en = "Silver recording methode badge";
            $l->nl = "Zilveren teltechnieken badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountlvl3Description";
            $l->en = "Gold recording method badge";
            $l->nl = "Gouden teltechnieken badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTechniqueCountLvl1RequirementDescription";
            $l->en = "1 recording method";
            $l->nl = "1 teltechniek";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeTechniqueCountLvl2RequirementDescription";
            $l->en = "2 recording methods";
            $l->nl = "2 teltechnieken";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTechniqueCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeTechniqueCountLvl3RequirementDescription";
            $l->en = "3 recording methods";
            $l->nl = "3 teltechnieken";
            $l->save();
        }




        $l = \App\Models\Language::where('key', 'badgeFitCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountTitle";
            $l->en = "Number of flower visit counts";
            $l->nl = "Aantal bloem bezoek tellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountDescription";
            $l->en = "Number of flower visit counts";
            $l->nl = "Aantal bloem bezoek tellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountlvl1Description";
            $l->en = "Bronze flower visit count badge";
            $l->nl = "Bronzen bloementelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountlvl2Description";
            $l->en = "Silver flower visit count badge";
            $l->nl = "Zilveren bloementelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountlvl3Description";
            $l->en = "Gold flower visit count badge";
            $l->nl = "Gouden bloementelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeFitCountLvl1RequirementDescription";
            $l->en = "5 flower visit counts";
            $l->nl = "5 bloementellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeFitCountLvl2RequirementDescription";
            $l->en = "10 flower visit counts";
            $l->nl = "10 bloementellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeFitCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeFitCountLvl3RequirementDescription";
            $l->en = "25 flower visit counts";
            $l->nl = "25 bloementellingen";
            $l->save();
        }




        $l = \App\Models\Language::where('key', 'badgeSsCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountTitle";
            $l->en = "Number of single observations";
            $l->nl = "Aantal losse waarnemingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountDescription";
            $l->en = "Number of single observations";
            $l->nl = "Aantal losse waarnemingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountlvl1Description";
            $l->en = "Bronze single observation badge";
            $l->nl = "Bronzen losse waarnemingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountlvl2Description";
            $l->en = "Silver single observation badge";
            $l->nl = "Zilveren losse waarnemingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountlvl3Description";
            $l->en = "Gold single observation badge";
            $l->nl = "Gouden losse waarnemingen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSsCountLvl1RequirementDescription";
            $l->en = "10 single observations";
            $l->nl = "10 losse waarnemingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeSsCountLvl2RequirementDescription";
            $l->en = "25 single observations";
            $l->nl = "25 losse waarnemingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSsCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeSsCountLvl3RequirementDescription";
            $l->en = "50 single observations";
            $l->nl = "50 losse waarnemingen";
            $l->save();
        }



        $l = \App\Models\Language::where('key', 'badgeTimedCountCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountTitle";
            $l->en = "Number of timed counts";
            $l->nl = "Aantal kwartiertellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountDescription";
            $l->en = "Number of timed counts";
            $l->nl = "Aantal kwartiertellingen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountlvl1Description";
            $l->en = "Bronze timed count badge";
            $l->nl = "Bronzen kwartiertelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountlvl2Description";
            $l->en = "Silver timed count badge";
            $l->nl = "Zilveren kwartiertelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountlvl3Description";
            $l->en = "Gold timed count badge";
            $l->nl = "Gouden kwartiertelling badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeTimedCountCountLvl1RequirementDescription";
            $l->en = "5 timed counts";
            $l->nl = "5 kwartiertelling";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeTimedCountCountLvl2RequirementDescription";
            $l->en = "10 timed counts";
            $l->nl = "10 kwartiertelling";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeTimedCountCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeTimedCountCountLvl3RequirementDescription";
            $l->en = "25 timed counts";
            $l->nl = "25 kwartiertelling";
            $l->save();
        }

    






        print("Done!!!!");

    }
}
