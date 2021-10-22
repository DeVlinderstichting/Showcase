<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionsUsers extends Model
{
    use HasFactory;
    protected $table = 'regions_users';
    protected $fillable = ['user_id', 'region_id'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
