<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    protected $table = 'measurements';


    public function species()
    {
        return $this->hasManyThrough('App\Models\Species', 'App\Models\MeasurementsSpecies', 'measurement_id', 'species_id', 'id', 'id');
    }
}
