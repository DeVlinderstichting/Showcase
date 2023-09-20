<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BadgeLevel;
use App\Models\BadgeRequirementType;

class BadgeLevelRequirement extends Model
{
    protected $table = "badgelevel_requirements";

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
    }
    public function isCompleted(User $user)
    {
        $brType = $this->badgeRequirementType()->get();
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




/*kmwalked
speciesinspeciesgroupcount


 */
    }
}
