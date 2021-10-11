<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationUsers extends Model
{
    use HasFactory;
    protected $table = 'observation_users';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function observation()
    {
        return $this->belongsTo('App\Models\Observation', 'observation_id', 'id');
    }

}
