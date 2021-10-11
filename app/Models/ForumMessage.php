<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumMessage extends Model
{
    use HasFactory;

    public function forumThread()
    {
        return $this->belongsTo('App\Models\ForumThread');
    }
    public function byUser()
    {
        return $this->belongsTo('App\Models\User', 'createdby_userid');
    }
}
