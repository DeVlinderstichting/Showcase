<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class observation extends Model
{
    use HasFactory;
    protected $table = 'observations';

    public function visit()
    {
        return $this->belongsTo('App\Models\Visit', 'visit_id', 'id');
    }

    public function species()
    {
        return $this->belongsTo('App\Models\Species', 'species_id', 'id');
    }
}
