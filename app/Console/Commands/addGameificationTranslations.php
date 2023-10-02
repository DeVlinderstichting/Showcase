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



        $l = \App\Models\Language::where('key', 'regionMoreInfo')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "regionMoreInfo";
            $l->en = "More information";
            $l->nl = "Meer informatie";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'regionInfoBeforeTime')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoBeforeTime";
            $l->en = "All recorders combined spend a total of";
            $l->nl = "Alle tellers samen hebben in totaal";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoAfterTime')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoAfterTime";
            $l->en = "minutes recording.";
            $l->nl = "minuten geteld.";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoBeforeDistance')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoBeforeDistance";
            $l->en = "All recorders combined traveled a distance of";
            $l->nl = "Alle tellers samen hebben een afstand van";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoAfterDistance')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoAfterDistance";
            $l->en = "meter.";
            $l->nl = "meter afgelegd.";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoBeforeIndivCount')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoBeforeIndivCount";
            $l->en = "In total";
            $l->nl = "In totaal zijn er";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoBetweenIndivCountAndSpNr')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoBetweenIndivCountAndSpNr";
            $l->en = "individuals were recorded, covering";
            $l->nl = "individuen waargenomen. Van";
            $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoAfterNrOfSpecies')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
            $l->key = "regionInfoAfterNrOfSpecies";
            $l->en = "different species.";
            $l->nl = "verschillende soorten.";
            $l->save();

        $l = \App\Models\Language::where('key', 'regionInfoPieChartSpeciesInEba')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "regionInfoPieChartSpeciesInEba";
        $l->en = "Species in EBA";
        $l->nl = "Soorten in de EBA";
        $l->save();

        $l = \App\Models\Language::where('key', 'regionInfoPieChartLandscapesInEba')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "regionInfoPieChartLandscapesInEba";
        $l->en = "Landscapes in EBA";
        $l->nl = "Landschappen in de EBA";
        $l->save();
        
        $l = \App\Models\Language::where('key', 'regionInfoPieChartManagementInEba')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "regionInfoPieChartManagementInEba";
        $l->en = "Management in EBA";
        $l->nl = "Beheer in de EBA";
        $l->save();

        $l = \App\Models\Language::where('key', 'regionInfoVisitsPerYearTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "regionInfoVisitsPerYearTitle";
        $l->en = "Number of visits per year";
        $l->nl = "Aantal tellingen per jaar";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeUsername')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeUsername";
        $l->en = "Username";
        $l->nl = "Gebruikersnaam";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeContributionToEba')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeContributionToEba";
        $l->en = "Contribution to EBA";
        $l->nl = "Bijdrage aan EBA";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeSmallContributor')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeSmallContributor";
        $l->en = "Enthusiastic recorder";
        $l->nl = "Enthousiast vrijwilliger";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeMediumContributor')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeMediumContributor";
        $l->en = "Active recorder";
        $l->nl = "Actieve vrijwilliger";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeLargeContributor')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeLargeContributor";
        $l->en = "Professional recorder";
        $l->nl = "Professioneel veldwerker";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeLargestContributor')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeLargestContributor";
        $l->en = "Grand contributor";
        $l->nl = "Zeer grote bijdrager";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeRecorderNumber')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeRecorderNumber";
        $l->en = "Recorder number";
        $l->nl = "Teller nummer";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeSpCountHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeSpCountHorizontalGraphItemLabel";
        $l->en = "Species count";
        $l->nl = "Aantal soorten";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeSpCountHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeSpCountHorizontalGraphItemTitle";
        $l->en = "Contribution to total species count";
        $l->nl = "Bijdrage aan totaal soorten aantal";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeSpCountHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeSpCountHorizontalGraphItemMyLabel";
        $l->en = "My species count";
        $l->nl = "Mijn soorten aantal";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeSpCountHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeSpCountHorizontalGraphItemEbaLabel";
        $l->en = "Other species in EBA";
        $l->nl = "Andere soorten in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeVisitCountHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitCountHorizontalGraphItemLabel";
        $l->en = "Visit count";
        $l->nl = "Aantal tellingen";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitCountHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitCountHorizontalGraphItemTitle";
        $l->en = "Contribution to total visit count";
        $l->nl = "Bijdrage aan totaal aantal tellingen";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitCountHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitCountHorizontalGraphItemMyLabel";
        $l->en = "My visit count";
        $l->nl = "Mijn aantal tellingen";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitCountHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitCountHorizontalGraphItemEbaLabel";
        $l->en = "Other visits in EBA";
        $l->nl = "Andere tellingen in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeDistanceSumHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeDistanceSumHorizontalGraphItemLabel";
        $l->en = "Total distance walked";
        $l->nl = "Totaal gelopen afstand";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeDistanceSumHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeDistanceSumHorizontalGraphItemTitle";
        $l->en = "Contribution to total distance traveled";
        $l->nl = "Bijdrage aan totaal gelopen afstand";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeDistanceSumHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeDistanceSumHorizontalGraphItemMyLabel";
        $l->en = "My distance";
        $l->nl = "Mijn afstand";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeDistanceSumHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeDistanceSumHorizontalGraphItemEbaLabel";
        $l->en = "Distance by other recorders in EBA";
        $l->nl = "Afstand van anderen in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeIndivCountHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeIndivCountHorizontalGraphItemLabel";
        $l->en = "Pollinators recorded";
        $l->nl = "Aantal bestuivers";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeIndivCountHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeIndivCountHorizontalGraphItemTitle";
        $l->en = "Contribution to total observations";
        $l->nl = "Bijdrage aan totaal aantal observaties";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeIndivCountHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeIndivCountHorizontalGraphItemMyLabel";
        $l->en = "My observations";
        $l->nl = "Mijn observaties";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeIndivCountHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeIndivCountHorizontalGraphItemEbaLabel";
        $l->en = "Observations by others in EBA";
        $l->nl = "Observaties door anderen in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeVisitTimeCountHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitTimeCountHorizontalGraphItemLabel";
        $l->en = "Visit time";
        $l->nl = "Tellingtijd";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitTimeCountHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitTimeCountHorizontalGraphItemTitle";
        $l->en = "Contribution to total visit time";
        $l->nl = "Bijdrage aan totale tellingtijd";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitTimeCountHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitTimeCountHorizontalGraphItemMyLabel";
        $l->en = "My time";
        $l->nl = "Mijn tijd";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeVisitTimeCountHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeVisitTimeCountHorizontalGraphItemEbaLabel";
        $l->en = "Time by others in EBA";
        $l->nl = "Tijd van anderen in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeBadgeCountHorizontalGraphItemLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeBadgeCountHorizontalGraphItemLabel";
        $l->en = "Badge count";
        $l->nl = "Aantal badges";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeBadgeCountHorizontalGraphItemTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeBadgeCountHorizontalGraphItemTitle";
        $l->en = "Contribution to total badge count in EBA";
        $l->nl = "Bijdrage aan totale hoeveelheid badges in EBA";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeBadgeCountHorizontalGraphItemMyLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeBadgeCountHorizontalGraphItemMyLabel";
        $l->en = "My badges";
        $l->nl = "Mijn badges";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeBadgeCountHorizontalGraphItemEbaLabel')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeBadgeCountHorizontalGraphItemEbaLabel";
        $l->en = "Badges by others in EBA";
        $l->nl = "Badges van anderen in de EBA";
        $l->save();



        $l = \App\Models\Language::where('key', 'userHomeEbaStatsHeader')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeEbaStatsHeader";
        $l->en = "Eba statistics";
        $l->nl = "Eba statistieken";
        $l->save();

        $l = \App\Models\Language::where('key', 'userHomeToStats')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userHomeToStats";
        $l->en = "User statistics";
        $l->nl = "Gebruikers statistieken";
        $l->save();

        $l = \App\Models\Language::where('key', 'userStatsLandscapeGraphTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsLandscapeGraphTitle";
        $l->en = "Landscape composition";
        $l->nl = "Samenstelling landschap";
        $l->save();

        $l = \App\Models\Language::where('key', 'userStatsManagementGraphTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsManagementGraphTitle";
        $l->en = "Management composition";
        $l->nl = "Samenstelling beheer";
        $l->save();

        $l = \App\Models\Language::where('key', 'userStatsLandscapeGraphYAxisSpCount')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsLandscapeGraphYAxisSpCount";
        $l->en = "Species count";
        $l->nl = "Aantal soorten";
        $l->save();
        $l = \App\Models\Language::where('key', 'userStatsManagementGraphYAxisSpCount')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsManagementGraphYAxisSpCount";
        $l->en = "Species count";
        $l->nl = "Aantal soorten";
        $l->save();

        $l = \App\Models\Language::where('key', 'userStatsLandscapeGraphYAxisIndiv')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsLandscapeGraphYAxisIndiv";
        $l->en = "Number of individuals";
        $l->nl = "Aantal individuen";
        $l->save();
        $l = \App\Models\Language::where('key', 'userStatsManagementGraphYAxisIndiv')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
        }
        $l->key = "userStatsManagementGraphYAxisIndiv";
        $l->en = "Number of individuals";
        $l->nl = "Aantal individuen";
        $l->save();


        print("Done!!!!");

    }
}
