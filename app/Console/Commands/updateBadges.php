<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Badge;
use \App\Models\BadgeLevel;
use \App\Models\BadgeLevelRequirement;
use \App\Models\BadgeRequirementType;


class updateBadges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateBadges';

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
        $bl = BadgeLevel::where('description_key', 'badgeSpeciesCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_1speciescount-bronce.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeSpeciesCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_1speciescount-silver.png";
        $bl->save();
        
        $bl = BadgeLevel::where('description_key', 'badgeSpeciesCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_1speciescount-gold.png";
        $bl->save();



        $bl = BadgeLevel::where('description_key', 'badgeVisitCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_5visitcount-bronce.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeVisitCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_5visitcount-silver.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeVisitCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_5visitcount-gold.png";
        $bl->save();



        $bl = BadgeLevel::where('description_key', 'badgeTechniqueCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_6recordingtechniques-bronce.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeTechniqueCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_3timemonitored-silver.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeTechniqueCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_6recordingtechniques-gold.png";
        $bl->save();



         $bl = BadgeLevel::where('description_key', 'badgeFitCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_7flowervisits-bronce.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeFitCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_7flowervisits-silver.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeFitCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_7flowervisits-gold.png";
        $bl->save();



        $bl = BadgeLevel::where('description_key', 'badgeSsCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_8somethingspecialcount-bronze.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeSsCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_8somethingspecialcount-silver.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeSsCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_8somethingspecialcount-gold.png";
        $bl->save();
        


        $bl = BadgeLevel::where('description_key', 'badgeTimedCountCountlvl1Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_915mcounts-bronze.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeTimedCountCountlvl2Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_915mcounts-silver.png";
        $bl->save();

        $bl = BadgeLevel::where('description_key', 'badgeTimedCountCountlvl3Description')->first();
        $bl->image_location = "\images\icons\AppShowcase_915mcounts-gold.png";
        $bl->save();


        $brtSpeciesGroupCount = BadgeRequirementType::where('requirementtype', 'speciesgroupcount')->first();
        if ($brtSpeciesGroupCount == null)
        {
            $brtSpeciesGroupCount = BadgeRequirementType::create(['requirementtype' => 'speciesgroupcount']);
        }

        $badgeSpeciesGroup = Badge::where('language_key', 'badgeSpeciesGroupTitle')->first();
        if ($badgeSpeciesGroup == null)
        {
            $badgeSpeciesGroup = Badge::create(['language_key' => "badgeSpeciesGroupTitle", 'description_key' => "badgeSpeciesGroupDescription"]);
        }
        $badgeVl1SpeciesGroup = BadgeLevel::where('description_key', 'badgeSpeciesGrouplvl1Description')->first();
        if ($badgeVl1SpeciesGroup == null)
        {
            $badgeVl1SpeciesGroup = BadgeLevel::create(['badge_id' => $badgeSpeciesGroup->id, 'description_key' => 'badgeSpeciesGrouplvl1Description','sequence' => 1, 'image_location' => '\images\icons\AppShowcase_2numberofspecies-bronce.png']);
        }
        $badgeVl2SpeciesGroup = BadgeLevel::where('description_key', 'badgeSpeciesGrouplvl2Description')->first();
        if ($badgeVl2SpeciesGroup == null)
        {
            $badgeVl2SpeciesGroup = BadgeLevel::create(['badge_id' => $badgeSpeciesGroup->id, 'description_key' => 'badgeSpeciesGrouplvl2Description','sequence' => 2, 'image_location' => '\images\icons\AppShowcase_2numberofspecies-silver.png']);
        }
        $badgeVl3SpeciesGroup = BadgeLevel::where('description_key', 'badgeSpeciesGrouplvl3Description')->first();
        if ($badgeVl3SpeciesGroup == null)
        {
            $badgeVl3SpeciesGroup = BadgeLevel::create(['badge_id' => $badgeSpeciesGroup->id, 'description_key' => 'badgeSpeciesGrouplvl3Description','sequence' => 3, 'image_location' => '\images\icons\AppShowcase_2numberofspecies-gold.png']);
        }

        $bl1Br = BadgeLevelRequirement::where('description_key', 'badgeSpeciesGroupLvl1RequirementDescription')->first();
        if ($bl1Br == null)
        {
            $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1SpeciesGroup->id, 'description_key' => 'badgeSpeciesGroupLvl1RequirementDescription', 'badgerequirementtype_id' => $brtSpeciesGroupCount->id, 'requirement_value' => 1]);
        }
        $bl2Br = BadgeLevelRequirement::where('description_key', 'badgeSpeciesGroupLvl2RequirementDescription')->first();
        if ($bl2Br == null)
        {
            $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2SpeciesGroup->id, 'description_key' => 'badgeSpeciesGroupLvl2RequirementDescription', 'badgerequirementtype_id' => $brtSpeciesGroupCount->id, 'requirement_value' => 3]);
        }
        $bl3Br = BadgeLevelRequirement::where('description_key', 'badgeSpeciesGroupLvl3RequirementDescription')->first();
        if ($bl3Br == null)
        {
            $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3SpeciesGroup->id, 'description_key' => 'badgeSpeciesGroupLvl3RequirementDescription', 'badgerequirementtype_id' => $brtSpeciesGroupCount->id, 'requirement_value' => 5]);
        }

        $l = \App\Models\Language::where('key', 'badgeSpeciesGroupTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGroupTitle";
            $l->en = "Species groups counted";
            $l->nl = "Aantal soortgroepen geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGroupDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGroupDescription";
            $l->en = "Species groups counted";
            $l->nl = "Aantal soortgroepen geteld";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGrouplvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGrouplvl1Description";
            $l->en = "Bronze species group badge";
            $l->nl = "Bronzen soortgroepen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGrouplvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGrouplvl2Description";
            $l->en = "Silver species group badge ";
            $l->nl = "Zilveren soortgroepen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGrouplvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGrouplvl3Description";
            $l->en = "Gold species group badge";
            $l->nl = "Gouden soortgroepen badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGroupLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeSpeciesGroupLvl1RequirementDescription";
            $l->en = "1 species groups";
            $l->nl = "1 soortgroepen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGroupLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeSpeciesGroupLvl2RequirementDescription";
            $l->en = "3 species groups";
            $l->nl = "3 soortgroepen";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeSpeciesGroupLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeSpeciesGroupLvl3RequirementDescription";
            $l->en = "5 species groups";
            $l->nl = "5 soortgroepen";
            $l->save();
        }

        
        $brtMonitoredTime = BadgeRequirementType::where('requirementtype', 'totalvisittime')->first();
        if ($brtMonitoredTime == null)
        {
            $brtMonitoredTime = BadgeRequirementType::create(['requirementtype' => 'totalvisittime']);
        }
        $badgeMonitoringTime = Badge::where('language_key', 'badgeMonitoringTimeTitle')->first();
        if ($badgeMonitoringTime == null)
        {
            $badgeMonitoringTime = Badge::create(['language_key' => "badgeMonitoringTimeTitle", 'description_key' => "badgeMonitoringTimeDescription"]);
        }

        $badgeVl1MonitoringTime = BadgeLevel::where('description_key', 'badgeMonitoringTimelvl1Description')->first();
        if ($badgeVl1MonitoringTime == null)
        {
            $badgeVl1MonitoringTime = BadgeLevel::create(['badge_id' => $badgeMonitoringTime->id, 'description_key' => 'badgeMonitoringTimelvl1Description','sequence' => 1, 'image_location' => '\images\icons\AppShowcase_3timemonitored-bronce.png']);
        }
        $badgeVl2MonitoringTime = BadgeLevel::where('description_key', 'badgeMonitoringTimelvl2Description')->first();
        if ($badgeVl2MonitoringTime == null)
        {
            $badgeVl2MonitoringTime = BadgeLevel::create(['badge_id' => $badgeMonitoringTime->id, 'description_key' => 'badgeMonitoringTimelvl2Description','sequence' => 2, 'image_location' => '\images\icons\AppShowcase_3timemonitored-silver.png']);
        }
        $badgeVl3MonitoringTime = BadgeLevel::where('description_key', 'badgeMonitoringTimelvl3Description')->first();
        if ($badgeVl3MonitoringTime == null)
        {
            $badgeVl3MonitoringTime = BadgeLevel::create(['badge_id' => $badgeMonitoringTime->id, 'description_key' => 'badgeMonitoringTimelvl3Description','sequence' => 3, 'image_location' => '\images\icons\AppShowcase_3timemonitored-gold.png']);
        }

        $bl1Br = BadgeLevelRequirement::where('description_key', 'badgeMonitoringTimeLvl1RequirementDescription')->first();
        if ($bl1Br == null)
        {
            $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1MonitoringTime->id, 'description_key' => 'badgeMonitoringTimeLvl1RequirementDescription', 'badgerequirementtype_id' => $brtMonitoredTime->id, 'requirement_value' => 60]);
        }
        $bl2Br = BadgeLevelRequirement::where('description_key', 'badgeMonitoringTimeLvl2RequirementDescription')->first();
        if ($bl2Br == null)
        {
            $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2MonitoringTime->id, 'description_key' => 'badgeMonitoringTimeLvl2RequirementDescription', 'badgerequirementtype_id' => $brtMonitoredTime->id, 'requirement_value' => 180]);
        }
        $bl3Br = BadgeLevelRequirement::where('description_key', 'badgeMonitoringTimeLvl3RequirementDescription')->first();
        if ($bl3Br == null)
        {
            $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3MonitoringTime->id, 'description_key' => 'badgeMonitoringTimeLvl3RequirementDescription', 'badgerequirementtype_id' => $brtMonitoredTime->id, 'requirement_value' => 600]);
        }



        $l = \App\Models\Language::where('key', 'badgeMonitoringTimeTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimeTitle";
            $l->en = "Time monitored";
            $l->nl = "Tijd gemonitord";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimeDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimeDescription";
            $l->en = "Time monitored";
            $l->nl = "Time monitord";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimelvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimelvl1Description";
            $l->en = "Bronze time badge";
            $l->nl = "Bronzen tijd badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimelvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimelvl2Description";
            $l->en = "Silver time badge";
            $l->nl = "Zilveren tijd badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimelvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimelvl3Description";
            $l->en = "Gold time badge";
            $l->nl = "Gouden tijd badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimeLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgeMonitoringTimeLvl1RequirementDescription";
            $l->en = "1 hour";
            $l->nl = "1 uur";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimeLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeMonitoringTimeLvl2RequirementDescription";
            $l->en = "3 hours";
            $l->nl = "3 uur";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgeMonitoringTimeLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgeMonitoringTimeLvl3RequirementDescription";
            $l->en = "10 hours";
            $l->nl = "10 uur";
            $l->save();
        }



        $brtPlantSpeciesCount = BadgeRequirementType::where('requirementtype', 'numberofplantspecies')->first();
        if ($brtPlantSpeciesCount == null)
        {
            $brtPlantSpeciesCount = BadgeRequirementType::create(['requirementtype' => 'numberofplantspecies']);
        }

        $badgePlantCount = Badge::where('language_key', 'badgePlantCountTitle')->first();
        if ($badgePlantCount == null)
        {
            $badgePlantCount = Badge::create(['language_key' => "badgePlantCountTitle", 'description_key' => "badgePlantCountDescription"]);
        }
        $badgeVl1PlantCount = BadgeLevel::where('description_key', 'badgePlantCountlvl1Description')->first();
        if ($badgeVl1PlantCount == null)
        {
            $badgeVl1PlantCount = BadgeLevel::create(['badge_id' => $badgePlantCount->id, 'description_key' => 'badgePlantCountlvl1Description','sequence' => 1, 'image_location' => '\images\icons\AppShowcase_4plantscounted-bronce.png']);
        }
        $badgeVl2PlantCount = BadgeLevel::where('description_key', 'badgePlantCountlvl2Description')->first();
        if ($badgeVl2PlantCount == null)
        {
            $badgeVl2PlantCount = BadgeLevel::create(['badge_id' => $badgePlantCount->id, 'description_key' => 'badgePlantCountlvl2Description','sequence' => 2, 'image_location' => '\images\icons\AppShowcase_4plantscounted-silver.png']);
        }
        $badgeVl3PlantCount = BadgeLevel::where('description_key', 'badgePlantCountlvl3Description')->first();
        if ($badgeVl3PlantCount == null)
        {
            $badgeVl3PlantCount = BadgeLevel::create(['badge_id' => $badgePlantCount->id, 'description_key' => 'badgePlantCountlvl3Description','sequence' => 3, 'image_location' => '\images\icons\AppShowcase_4plantscounted-gold.png']);
        }

        $bl1Br = BadgeLevelRequirement::where('description_key', 'badgePlantCountLvl1RequirementDescription')->first();
        if ($bl1Br == null)
        {
            $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1PlantCount->id, 'description_key' => 'badgePlantCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtPlantSpeciesCount->id, 'requirement_value' => 5]);
        }
        $bl2Br = BadgeLevelRequirement::where('description_key', 'badgePlantCountLvl2RequirementDescription')->first();
        if ($bl2Br == null)
        {
            $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2PlantCount->id, 'description_key' => 'badgePlantCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtPlantSpeciesCount->id, 'requirement_value' => 10]);
        }
        $bl3Br = BadgeLevelRequirement::where('description_key', 'badgePlantCountLvl3RequirementDescription')->first();
        if ($bl3Br == null)
        {
            $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3PlantCount->id, 'description_key' => 'badgePlantCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtPlantSpeciesCount->id, 'requirement_value' => 25]);
        }

        $l = \App\Models\Language::where('key', 'badgePlantCountTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountTitle";
            $l->en = "Number of plant species";
            $l->nl = "Aantal plantensoorten";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountDescription";
            $l->en = " Number of plant species ";
            $l->nl = " Aantal plantensoorten ";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountlvl1Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountlvl1Description";
            $l->en = "Bronze plant badge";
            $l->nl = "Bronzen planten badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountlvl2Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountlvl2Description";
            $l->en = "Silver plant badge";
            $l->nl = "Zilveren planten badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountlvl3Description')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountlvl3Description";
            $l->en = "Gold plant badge";
            $l->nl = "Gouden planten badge";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountLvl1RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "badgePlantCountLvl1RequirementDescription";
            $l->en = "5 plant species";
            $l->nl = "5 plantensoorten";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountLvl2RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgePlantCountLvl2RequirementDescription";
            $l->en = "10 plant species";
            $l->nl = "10 plantensoorten";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'badgePlantCountLvl3RequirementDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language();
            $l->key = "badgePlantCountLvl3RequirementDescription";
            $l->en = "25 plant species";
            $l->nl = "25 plant species";
            $l->save();
        }
    }
}
