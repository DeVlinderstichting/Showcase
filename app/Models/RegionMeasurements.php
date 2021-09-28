<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionMeasurements extends Model
{
    use HasFactory;
    protected $table = 'region_measurements';

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }

    public function measurement()
    {
        return $this->belongsTo('App\Models\Measurement', 'measurement_id', 'id');
    }

}
