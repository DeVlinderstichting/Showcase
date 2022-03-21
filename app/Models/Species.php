<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;
    protected $table = 'species';

    public function speciesgroup()
    {
        return $this->belongsTo('App\Models\Speciesgroup', 'speciesgroup_id', 'id');
    }
    public function getName(User $user)
    {
        return $this->enname; //update this to incorporate other languages based on user settings 
    }

}
