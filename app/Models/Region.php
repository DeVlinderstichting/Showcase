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
        return $this->belongsToMany('App\Models\User', 'regions_users', 'region_id', 'user_id');
    }

    public function species()
    {
        return $this->belongsToMany('App\Models\Species', 'regions_species', 'region_id', 'species_id');
    }
}
