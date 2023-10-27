<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeRequirementType extends Model
{
    protected $table = "badge_requirement_types";
    protected $fillable = ['requirementtype'];
}
