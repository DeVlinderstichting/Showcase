<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionsSpecies extends Model
{
    use HasFactory;
    protected $table = 'regions_species';

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }

    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_id', 'id');
    }

}
