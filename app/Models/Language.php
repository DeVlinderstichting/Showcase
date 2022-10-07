<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Language extends Model
{
    use HasFactory;

    /**
    * Get the translation of an item in a certain language
    * 
    * This language is the logged-in user's preference or languageName, if it
    * does not equal 'en'. If no translation is found, then 'en' is used.
    * 
    * @param string $key 
    * @param string $languageName
    * @return string translation of the key
    */
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
