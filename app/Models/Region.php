<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regions';

    public function observations()
    {
        return $this->hasMany('App\Models\PushMessage');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'regions_users', 'region_id', 'user_id');
    }

    public function species()
    {
        return $this->belongsToMany('App\Models\Species', 'regions_species', 'region_id', 'species_id');
    }

    public function getLocationsAsGeoJson()
    {
    //    dd($this->id);
        $res = DB::select(DB::raw("SELECT ST_AsGeoJSON(location) as location from regions WHERE id = {$this->id}"))[0]->location;
        //$res = DB::select("SELECT ST_AsGeoJSON(location) from regions where id = {$this->id}");
   //   dd($res);
        return $res;
        /*

        $res = DB::select("SELECT JSONB_BUILD_OBJECT(
                'type','FeatureCollection',
                'features', JSONB_AGG(ST_AsGeoJSON(fc.*)::JSONB)
               )
        FROM  (
        SELECT *
          FROM regions 
          WHERE id = {$this->id}
        ) AS fc;");
        return $res[0]->jsonb_build_object; */
    }
}
