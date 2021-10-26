<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodSpeciesgroupRecordinglevel extends Model
{
    use HasFactory;
    protected $fillable = ['method_id', 'speciesgroup_id', 'recordinglevel_id'];

    public function method()
    {
        return $this->belongsTo('App\Models\Method');
    }
    public function recordinglevel()
    {
        return $this->belongsTo('App\Models\RecordingLevel', 'recordinglevel_id', 'id');
    }
    public function speciesgroup()
    {
        return $this->belongsTo('App\Models\SpeciesGroup', 'speciesgroup_id', 'id');
    }
}
