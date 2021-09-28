<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countobject extends Model
{
    use HasFactory;
    protected $table = 'countobjects';

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'countobject_users', 'countobject_id', 'user_id');
    }
    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }
    public function visits()
    {
        return $this->hasMany('App\Visit', 'countobject_id');
    }
    public function locations()
    {
        return $this->hasManyThrough('App\Models\Location', 'App\Models\CountobjectLocation', 'countobject_id', 'location_id', 'id', 'id');
    }
}
