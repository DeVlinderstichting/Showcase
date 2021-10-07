<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountobjectUsers extends Model
{
    use HasFactory;
    protected $table = 'countobject_users';

    public function countobject()
    {
        return $this->belongsTo('App\Models\Countobject', 'countobject_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
