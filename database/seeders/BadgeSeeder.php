<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use \App\Models\BadgeRequirementType;
use \App\Models\Badge;
use \App\Models\BadgeLevel;
use \App\Models\BadgeLevelRequirement;
use Hash;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brtSpCount = BadgeRequirementType::create(['requirementtype' => 'speciescount']);
        $brtWalked = BadgeRequirementType::create(['requirementtype' => 'kmwalked']);
        $brtSpInGroup = BadgeRequirementType::create(['requirementtype' => 'speciesinspeciesgroupcount']);
        $brtVisitCount = BadgeRequirementType::create(['requirementtype' => 'visitcount']);
        $brtMethodCount = BadgeRequirementType::create(['requirementtype' => 'methodcount']);
        $brtRecordingLevelCount = BadgeRequirementType::create(['requirementtype' => 'recordinglevelcount']);

        $tenSp = Badge::create(['language_key' => "badgeSpeciesCountTitle",'description_key' => "badgeSpeciesCountDescription"]);
        $bl1TenSp = BadgeLevel::create(['badge_id' => $tenSp->id, 'description_key' => 'badgeSpeciesCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $bl2TenSp = BadgeLevel::create(['badge_id' => $tenSp->id, 'description_key' => 'badgeSpeciesCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $bl3TenSp = BadgeLevel::create(['badge_id' => $tenSp->id, 'description_key' => 'badgeSpeciesCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $bl1TenSp->id, 'description_key' => 'badgeSpeciesCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtSpCount->id, 'requirement_value' => 10]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $bl2TenSp->id, 'description_key' => 'badgeSpeciesCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtSpCount->id, 'requirement_value' => 25]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $bl3TenSp->id, 'description_key' => 'badgeSpeciesCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtSpCount->id, 'requirement_value' => 50]);


        $badgeVisitCount = Badge::create(['language_key' => "badgeVisitCountTitle", 'description_key' => "badgeVisitCountDescription"]);
        $badgeVl1visitCount = BadgeLevel::create(['badge_id' => $badgeVisitCount->id, 'description_key' => 'badgeVisitCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $badgeVl2visitCount = BadgeLevel::create(['badge_id' => $badgeVisitCount->id, 'description_key' => 'badgeVisitCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $badgeVl3visitCount = BadgeLevel::create(['badge_id' => $badgeVisitCount->id, 'description_key' => 'badgeVisitCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1visitCount->id, 'description_key' => 'badgeVisitCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtVisitCount->id, 'requirement_value' => 5]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2visitCount->id, 'description_key' => 'badgeVisitCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtVisitCount->id, 'requirement_value' => 10]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3visitCount->id, 'description_key' => 'badgeVisitCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtVisitCount->id, 'requirement_value' => 25]);


        $badgeTechniqueCount = Badge::create(['language_key' => "badgeTechniqueCountTitle", 'description_key' => "badgeTechniqueCountDescription"]);
        $badgeVl1TechniqueCount = BadgeLevel::create(['badge_id' => $badgeTechniqueCount->id, 'description_key' => 'badgeTechniqueCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $badgeVl2TechniqueCount = BadgeLevel::create(['badge_id' => $badgeTechniqueCount->id, 'description_key' => 'badgeTechniqueCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $badgeVl3TechniqueCount = BadgeLevel::create(['badge_id' => $badgeTechniqueCount->id, 'description_key' => 'badgeTechniqueCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1TechniqueCount->id, 'description_key' => 'badgeTechniqueCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtMethodCount->id, 'requirement_value' => 1]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2TechniqueCount->id, 'description_key' => 'badgeTechniqueCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtMethodCount->id, 'requirement_value' => 2]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3TechniqueCount->id, 'description_key' => 'badgeTechniqueCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtMethodCount->id, 'requirement_value' => 3]);



        $badgeFitCount = Badge::create(['language_key' => "badgeFitCountTitle", 'description_key' => "badgeFitCountDescription"]);
        $badgeVl1FitCount = BadgeLevel::create(['badge_id' => $badgeFitCount->id, 'description_key' => 'badgeFitCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $badgeVl2FitCount = BadgeLevel::create(['badge_id' => $badgeFitCount->id, 'description_key' => 'badgeFitCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $badgeVl3FitCount = BadgeLevel::create(['badge_id' => $badgeFitCount->id, 'description_key' => 'badgeFitCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1FitCount->id, 'description_key' => 'badgeFitCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 5, 'additional_requirement_value'=> 4]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2FitCount->id, 'description_key' => 'badgeFitCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 10, 'additional_requirement_value'=> 4]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3FitCount->id, 'description_key' => 'badgeFitCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 25, 'additional_requirement_value'=> 4]);



        $badgeSsCount = Badge::create(['language_key' => "badgeSsCountTitle", 'description_key' => "badgeSsCountDescription"]);
        $badgeVl1SsCount = BadgeLevel::create(['badge_id' => $badgeSsCount->id, 'description_key' => 'badgeSsCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $badgeVl2SsCount = BadgeLevel::create(['badge_id' => $badgeSsCount->id, 'description_key' => 'badgeSsCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $badgeVl3SsCount = BadgeLevel::create(['badge_id' => $badgeSsCount->id, 'description_key' => 'badgeSsCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1SsCount->id, 'description_key' => 'badgeSsCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 10, 'additional_requirement_value' => 1]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2SsCount->id, 'description_key' => 'badgeSsCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 25, 'additional_requirement_value' => 1]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3SsCount->id, 'description_key' => 'badgeSsCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 50, 'additional_requirement_value' => 1]);



        $badgeTimedCountCount = Badge::create(['language_key' => "badgeTimedCountCountTitle", 'description_key' => "badgeTimedCountCountDescription"]);
        $badgeVl1TimedCountCount = BadgeLevel::create(['badge_id' => $badgeTimedCountCount->id, 'description_key' => 'badgeTimedCountCountlvl1Description','sequence' => 1, 'image_location' => '\img\flies.png']);
        $badgeVl2TimedCountCount = BadgeLevel::create(['badge_id' => $badgeTimedCountCount->id, 'description_key' => 'badgeTimedCountCountlvl2Description','sequence' => 2, 'image_location' => '\img\honeybees.png']);
        $badgeVl3TimedCountCount = BadgeLevel::create(['badge_id' => $badgeTimedCountCount->id, 'description_key' => 'badgeTimedCountCountlvl3Description','sequence' => 3, 'image_location' => '\img\hoverflies.png']);

        $bl1Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl1TimedCountCount->id, 'description_key' => 'badgeTimedCountCountLvl1RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 5, 'additional_requirement_value' => 2]);
        $bl2Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl2TimedCountCount->id, 'description_key' => 'badgeTimedCountCountLvl2RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 10, 'additional_requirement_value' => 2]);
        $bl3Br = BadgeLevelRequirement::create(['badgelevel_id' => $badgeVl3TimedCountCount->id, 'description_key' => 'badgeTimedCountCountLvl3RequirementDescription', 'badgerequirementtype_id' => $brtRecordingLevelCount->id, 'requirement_value' => 25, 'additional_requirement_value' => 2]);
    }
}
