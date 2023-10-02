<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BadgeLevelRequirement;

class BadgeLevel extends Model
{
    protected $table = "badge_levels";

    public function badge()
    {
        return $this->belongsTo('App\Models\Badge', 'badge_id', 'id');
    }
    public function badgeLevelRequirements()
    {
        return $this->hasMany('App\Models\BadgeLevelRequirement', 'badgelevel_id');
    }
    public function users()
    {
        // return $this->hasManyThrough(User::class, UserBadgelevel::class, 'badgelevel_id', 'user_id', 'id', 'id');

        $userIds = \App\Models\UserBadgelevel::where('badgelevel_id', $this->id)->pluck('user_id');
        if (!empty($userIds))
        {
            $users = \App\Models\User::whereIn('id', $userIds);
        }
        else 
        {
            $users = \App\Models\User::where('id', -1);
        }
        return $users; 
    }
    public function checkIsCompletedByUser(User $user)
    {
        $isCompleted = true;
        $allRequirements = $this->badgeLevelRequirements()->get();
        foreach($allRequirements as $req)
        {
            if (!($req->isCompleted($user)))
            {
                $isCompleted = false;
            }
        }
        return $isCompleted;
    }
    public function getProgressOfUser(User $user)
    {
        $totalProgress = 0;
        $reqCount = 0;
        $allRequirements = $this->badgeLevelRequirements()->get();
        foreach($allRequirements as $req)
        {
            $totalProgress += $req->getProgress($user);
            $reqCount++;
        }
        if ($reqCount > 0)
        {
            return (($totalProgress / $reqCount)*100);
        }
        return 0;
    }
    public function getRequirementsTooltip()
    {
        $res = "For this badge you need:";
        $allRequirements = $this->badgeLevelRequirements()->get();
        foreach($allRequirements as $req)
        {
            $res.="\n ->".\App\Models\Language::getItem($req->description_key);
        }
        return $res;
    }

    public function updateBadgelevelForUser(User $user)
    {
        if ($this->checkIsCompletedByUser($user))
        {
            $recordCount = \App\Models\UserBadgelevel::where('user_id', $user->id)->where('badgelevel_id', $this->id)->count();
            if ($recordCount == 0)
            {
                \App\Models\UserBadgelevel::create(['badgelevel_id' => $this->id, 'user_id' => $user->id]);
            }
        }
    }
}
