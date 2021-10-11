<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransectSections extends Model
{
    use HasFactory;

    public function observations()
    {
        return $this->hasMany('App\Models\Observation', 'transect_section_id');
    }
}
