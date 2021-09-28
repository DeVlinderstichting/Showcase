<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountobjectLocation extends Model
{
    use HasFactory;
    protected $table = 'countobject_locations';

    public function countobject()
    {
        return $this->belongsTo('App\Models\Countobject', 'countobject_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id', 'id');
    }
}
