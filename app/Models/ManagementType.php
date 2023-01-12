<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementType extends Model
{
    use HasFactory;
    protected $table = "managementtypes";
    protected $fillable = ['name', 'description'];
}
