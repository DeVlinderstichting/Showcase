<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function visit()
    {
        return $this->belongsTo('App\Models\Visit', 'visit_id', 'id');
    }
    public function observation()
    {
        return $this->belongsTo('App\Models\Observation', 'observation_id', 'id');
    }
}
