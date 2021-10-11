<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    public function speciesGroupRecordingLevel()
    {
        return $this->hasMany('App\Models\MethodSpeciesgroupRecordinglevel', 'method_id', 'id');
    }
}
