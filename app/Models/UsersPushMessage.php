<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPushMessage extends Model
{
    use HasFactory;

    protected $table = 'users_pushmessages';
    protected $fillable = ['pushmessage_id', 'user_id', 'senddate'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function pushmessage()
    {
        return $this->belongsTo('App\Models\PushMessage', 'pushmessage_id', 'id');
    }
}
