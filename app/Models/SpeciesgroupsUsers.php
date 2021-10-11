<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeciesgroupsUsers extends Model
{
    use HasFactory;
    protected $table = 'speciesgroups_users';

    public function speciesgroup()
    {
        return $this->belongsTo('App\Models\Speciesgroup', 'speciesgroup_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function recordinglevel()
    {
        return $this->belongsTo('App\Models\RecordingLevel', 'recordinglevel_id', 'id');
    }

}
