<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = ['title','introduction','maintext','moreinfo','image1','image2'];
}
