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
        if ($key == null)
        {
            return "";
        }
        $user = Auth::user();
        if ($user != null)
        {
            if ($languageName == "en")
            {
                $languageName = $user->prefered_language;
            }
        }
      //  $key = strtolower($key);
        $item = \App\Models\Language::where('key', $key)->first();
        if ($item == null)
        {
            $item = \App\Models\Language::where('key', strtolower($key))->first();
            if ($item == null)
            {
                $isItLanduse = \App\Models\LanduseType::where('name', 'ilike', $key)->first();

                if ($isItLanduse != null)
                {
                    return $isItLanduse->description;
                }
                $isItManagement = \App\Models\ManagementType::where('name', 'ilike', $key)->first();
                if ($isItManagement != null)
                {
                    return $isItManagement->description;
                }
               // return $key;
            }
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
