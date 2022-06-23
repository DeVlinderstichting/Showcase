<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public static function getItem($key, $languageName = 'en')
    {
        $item = \App\Models\Language::where('key', $key)->first();
        if ($item == null)
        {
            return "";
        }
        else 
        {
            if ($item->$languageName != '')
            {
                return $item->$languageName;
            }
            else 
            {
                return $item->en;
            }
        }
    }
}
