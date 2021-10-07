<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementsSpecies extends Model
{
    use HasFactory;
    protected $table = 'measurement_species';

    public function measurement()
    {
        return $this->belongsTo('App\Models\Measurement', 'measurement_id', 'id');
    }

    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_id', 'id');
    }

}
