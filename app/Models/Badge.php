<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserBadge;

class Badge extends Model
{
    public function badgeLevels()
    {
        return $this->hasMany('App\Models\BadgeLevel', 'badge_id');
    }

    public function getHighestBadgeLevelForUser(User $user)
    {
        $badgeLevels = $this->badgeLevels()->get();
        $currentHighest = null;
        foreach($badgeLevels as $bl)
        {
            $badgeUser = $bl->users()->where('id', $user->id)->get();         
            if ((!empty($badgeUser)) && ($badgeUser->count()!=0))
            {
                if (($currentHighest == null) || ($currentHighest->sequence < $bl->sequence))
                {
                    $currentHighest = \App\Models\BadgeLevel::find($bl->id);
                }
            }
        }
        return $currentHighest;
    }

    public function getProgressTowardsNextLevel(User $user)
    {
        $nextBadgeLevel = null;
        $highestBadgeLevel = $this->getHighestBadgeLevelForUser($user);
        if ($highestBadgeLevel == null)
        {
            $nextBadgeLevel = $this->getLowestBadgeLevel()->first();
        }
        else 
        {
            $badgeLevels = $this->badgeLevels()->get();
            $closestSequenceValue = -1;
            foreach($badgeLevels as $bl)
            {
                if ($bl->sequence > $highestBadgeLevel->sequence)
                {
                    if (($closestSequenceValue == -1) || (($closestSequenceValue - $highestBadgeLevel->sequence) > ($highestBadgeLevel->sequence - $bl->sequence)))
                    {
                        $closestSequenceValue = $bl->sequence;
                        $nextBadgeLevel = \App\Models\BadgeLevel::find($bl->id);
                    }
                }
            }
        }
        if (empty($nextBadgeLevel))
        {
            return 100;
        }
        else 
        {
            return $nextBadgeLevel->getProgressOfUser($user);
        }
    }

  /*  public function checkIsCompleted(User $user)
    {
        $badgeLevels = $this->badgeLevels()->get();
        foreach($badgeLevels as $bl)
        {
            $bl->checkIsCompletedByUser($user);
        }
    }*/

    public function getLowestBadgeLevel()
    {
        return $this->badgeLevels()->orderby('sequence')->take(1);
    }
    public function getHighestBadgeLevel()
    {
        return $this->badgeLevels()->orderby('sequence', 'desc')->take(1);
    }

    public function updateBadgeLevelForUser(User $user)
    {
        $badgeLevels = $this->badgeLevels()->get();
        foreach($badgeLevels as $bl)
        {
            $bl->updateBadgeLevelForUser($user);
        }
    }
}
