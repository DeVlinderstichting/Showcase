<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Species extends Model
{
    use HasFactory;
    protected $table = 'species';
    protected $fillable = ['genus', 'speciesgroup_id', 'taxrank', 'taxon', 'parent_id', 'diurnal'];

    public function speciesgroup()
    {
        return $this->belongsTo('App\Models\Speciesgroup', 'speciesgroup_id', 'id');
    }
    public function getName($user)
    {
        if ($user == null)
        {
            $user = Auth::user();
        }

        $varName = 'enname';
        if ($user != null)
        {
            $varName = $user->prefered_language . 'name';
        }
        
        if ($this->$varName == "")
        {
            return $this->genus . " " . $this->taxon;
        }
        return $this->$varName;
    }

}
