<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanduseType extends Model
{
    use HasFactory;
    protected $table = "landusetypes";
    protected $fillable = ['name', 'description'];
    
}
