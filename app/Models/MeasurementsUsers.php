<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementsUsers extends Model
{
    use HasFactory;
    protected $table = 'measurement_users';

    public function measurement()
    {
        return $this->belongsTo('App\Models\Measurement', 'measurement_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
