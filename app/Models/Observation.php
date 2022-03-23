<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class observation extends Model
{
    use HasFactory;
    protected $table = 'observations';

    public function visit()
    {
        return $this->belongsTo('App\Models\Visit', 'visit_id', 'id');
    }

    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Photos', 'visit_id');
    }
    public function transectSection()
    {
        return $this->belongsTo('App\Models\TransectSections', 'transect_section_id', 'id');
    }

    public function getLocationsAsGeoJson()
    {
        $res = DB::select("SELECT JSONB_BUILD_OBJECT(
                'type','FeatureCollection',
                'features', JSONB_AGG(ST_AsGeoJSON(fc.*)::JSONB)
               )
        FROM  (
        SELECT observations.species_id, observations.number, observations.visit_id, observations.transect_section_id, observations.location
          FROM observations
          WHERE observations.id = {$this->id}
        ) AS fc;");
        return $res[0]->jsonb_build_object;
    }
}
