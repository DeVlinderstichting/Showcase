<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';

    public function users()
    {
      return $this->hasManyThrough('App\Models\Users', 'App\Models\VisitUsers', 'visit_id', 'user_id', 'id', 'id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }

    public function observations()
    {
        return $this->hasMany('App\Models\Observation', 'visit_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Photos', 'visit_id');
    }

    public function method()
    {
        return $this->belongsTo('App\Models\Method', 'method_id', 'id');
    }
}
