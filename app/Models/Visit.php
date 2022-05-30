<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

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
    public function transect()
    {
        return $this->belongsTo('App\Models\Transect', 'region_id', 'id');
    }
    public function getDuration()
    {
        if (($this->startdate == null) || ($this->enddate == null))
        {
            return "-";
        }
        $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->startdate);
        $end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->enddate);
        $diff = $start->diffInHours($end) . ':' . str_pad($start->diffInMinutes($end) - (floor($start->diffInHours($end)) * 60), 2, '0', STR_PAD_LEFT);
        return $diff;
    }

    public function getLocationsAsGeoJson()
    {
        $res = DB::select("SELECT ST_AsGeoJSON(location) as loc from visits where id = $this->id");
        return $res[0]->loc;
    }
}
