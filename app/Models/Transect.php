<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transect extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\TransectsUsers', 'transect_id', 'user_id', 'id', 'id');
    }

    public function transectSections()
    {
        return $this->hasMany('App\Models\TransectSections', 'transect_id');
    }
}
