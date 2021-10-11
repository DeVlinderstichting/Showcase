<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    public function forumMessages()
    {
        return $this->hasMany('App\Model\ForumMessage', 'thread_id', 'id');
    }
    public function byUser()
    {
        return $this->belongsTo('App\Models\User', 'createdby_userid');
    }
}
