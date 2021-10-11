<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushMessage extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }
}
