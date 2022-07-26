<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Language extends Model
{
    use HasFactory;

    public static function getItem($key, $languageName = 'en')
    {
        $user = Auth::user();
        if ($user != null)
        {
            if ($languageName == "en")
            {
                $languageName = $user->prefered_language;
            }
        }

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
