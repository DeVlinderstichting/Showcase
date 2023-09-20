<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadgelevel extends Model
{
    protected $table = "user_badgelevels";
    protected $fillable = ['badgelevel_id', 'user_id'];
}
