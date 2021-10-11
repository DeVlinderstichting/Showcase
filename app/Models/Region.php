<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasManyThrough('App\Models\User', 'App\Models\RegionsUsers', 'region_id', 'user_id', 'id', 'id');
    }

    public function species()
    {
        return $this->hasManyThrough('App\Models\Species', 'App\Models\RegionsSpecies', 'region_id', 'species_id', 'id', 'id');
    }
}
