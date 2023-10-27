<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BadgeLevel;
use App\Models\BadgeRequirementType;
use DB;

class BadgeLevelRequirement extends Model
{
    protected $table = "badgelevel_requirements";
    protected $fillable = ['badgelevel_id', 'description_key', 'badgerequirementtype_id', 'requirement_value', 'additional_requirement_value'];


    public function badgeLevel()
    {
        return $this->belongsTo('App\Models\BadgeLevel', 'badgelevel_id', 'id');
    }
    public function badgeRequirementType()
    {
        return $this->belongsTo('App\Models\BadgeRequirementType', 'badgerequirementtype_id', 'id');
    }

    public function getProgress(User $user)
    {
        $brType = $this->badgeRequirementType()->first();
        if ($brType->requirementtype == 'speciescount')
        {
            $spCount = $user->observations()->select('species_id')->groupBy('species_id')->count();
            $progress = $spCount / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'visitcount')
        {
            $visitCount = $user->visits()->count();
            $progress = $visitCount / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'methodcount')
        {
            $countingMethodCount = $user->visits()->distinct('countingmethod_id')->count();
            $progress = $countingMethodCount / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'recordinglevelcount')
        {
            $countingMethodCount = $user->visits()->where('countingmethod_id', $this->additional_requirement_value)->count();
            $progress = $countingMethodCount / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'numberofplantspecies')
        {
            $flowerCount = $user->visits()->whereNotNull('flower_id')->pluck('flower_id')->unique()->count();
            $progress = $flowerCount / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'totalvisittime')
        {
            $totalVisitLength = DB::select(DB::raw("select sum(EXTRACT(EPOCH from (visits.enddate-visits.startdate)/60)) as visitlength from visits where user_id = $user->id and countingmethod_id in (2,4)"));
            $progress = $totalVisitLength[0]->visitlength / $this->requirement_value;
            return $progress;
        }
        if ($brType->requirementtype == 'speciesgroupcount')
        {
            $spIds = $user->observations()->pluck('species_id')->unique();
            $spGroupCount = \App\Models\Species::whereIn("id", $spIds)->pluck('speciesgroup_id')->unique()->count();
            $progress = $spGroupCount / $this->requirement_value;
            return $progress;
        }
    }
    public function isCompleted(User $user)
    {
        $brType = $this->badgeRequirementType()->first();
        if ($brType->requirementtype == 'speciescount')
        {
            $spCount = $user->observations()->select('species_id')->groupBy('species_id')->count();
            return ($spCount >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'visitcount')
        {
            $visitCount = $user->visits()->count();
            return ($visitCount >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'methodcount')
        {
            $countingMethodCount = $user->visits()->distinct('countingmethod_id')->count();
            return ($countingMethodCount >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'recordinglevelcount')
        {
            $countingMethodCount = $user->visits()->where('countingmethod_id', $this->additional_requirement_value)->count();
            return ($countingMethodCount >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'numberofplantspecies')
        {
            $flowerCount = $user->visits()->whereNotNull('flower_id')->pluck('flower_id')->unique()->count();
            return ($flowerCount >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'totalvisittime')
        {
            $totalVisitLength = DB::select(DB::raw("select sum(EXTRACT(EPOCH from (visits.enddate-visits.startdate)/60)) as visitlength from visits where user_id = $user->id and countingmethod_id in (2,4)"));
            return ($totalVisitLength >= $this->requirement_value);
        }
        if ($brType->requirementtype == 'speciesgroupcount')
        {
            $spIds = $user->observations()->pluck('species_id')->unique();
            $spGroupCount = \App\Models\Species::whereIn("id", $spIds)->pluck('speciesgroup_id')->unique()->count();
            return ($spGroupCount >= $this->requirement_value);
        }
    }
}
