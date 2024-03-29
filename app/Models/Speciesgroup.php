<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciesgroup extends Model
{
    use HasFactory;
    protected $table = 'speciesgroups';

    public function species()
    {
        return $this->hasMany('App\Models\Species', 'speciesgroup_id');
    }

}
