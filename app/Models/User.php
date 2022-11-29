<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\CountingMethodsUsers;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prefered_language',
        'accesstoken',
        'share_data'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function speciesgroupsRecordingLevels()
    {
        return $this->hasMany('App\Models\SpeciesgroupsUsers');
    }

    public function countingMethods()
    {
        $cmIds = CountingMethodsUsers::where('user_id', $this->id)->pluck('countingmethod_id');
        return \App\Models\CountingMethod::whereIn('id', $cmIds);
      //  return $this->hasManyThrough('App\Models\CountingMethod', 'App\Models\CountingMethodsUsers', 'user_id', 'id', 'countingmethod_id', 'id');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit', 'user_id', 'id');
    }
    public function regions()
    {
        return $this->belongsToMany('App\Models\Region', 'regions_users', 'user_id', 'region_id');
    }

    public function observations()
    {
        return $this->hasManyThrough('App\Models\Observation', 'App\Models\Visit', 'user_id', 'visit_id', 'id', 'id');
    }

    public function transects()
    {
        return $this->belongsToMany('App\Models\Transect', 'transects_users', 'user_id', 'transect_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'user_id');
    }

    public function usersMessages()
    {
        return $this->hasMany('App\Models\UsersPushMessage', 'user_id');
    }

    public function forumMessage()
    {
        return $this->hasMany('App\Models\ForumMessage', 'createdby_userid');
    }
    public function forumThread()
    {
        return $this->hasMany('App\Models\ForumThread', 'createdby_userid');
    }

    public function setRandomAccessToken()
    {
        $this->accesstoken = Str::random(80);
    }

    public function buildUserPackage()
    {
        $retArr = [];
        $userSettings = [];
        $regions = [];
        $species = [];
        $speciesGroups = [];
        $messages = [];
        $transects = [];
        $lang = [];
        $langAvailable = [];
        $managementTypes = [];
        $landuseTypes = [];


        /*$managementTypeIds = \App\Models\ManagementType::all()->pluck('id');
        $landUseTypeIds = \App\Models\LanduseType::all()->pluck('id');
        foreach($managementTypeIds as $mtid) 
        {
            $mt = \App\Models\ManagementType::find($mtid);
            $managementType = [];
            $managementType['id'] = $mt->id;
            $managementType['name'] = $mt->name;
            $managementType['description'] = $mt->description;
            $managementTypes[] = $managementType;
        }
        foreach($landUseTypeIds as $lutid)
        {
            $lt = \App\Models\LanduseType::find($lutid);
            $landuseType = [];
            $landuseType['id'] = $lt->id;
            $landuseType['name'] = $lt->name;
            $landuseType['description'] = $lt->description;
            $landuseTypes[] = $landuseType;
        }*/


        $userSettings['user_id'] = $this->id;
        $userSettings['preferedLanguage'] = $this->prefered_language;
        $userSettings['accessToken'] = $this->accesstoken;
        $userSettings['name'] = $this->name;
        $userSettings['email'] = $this->email;
        $userSettings['sci_names'] = $this->sci_names;
        $userSettings['showPreviouslyObservedSpecies'] = $this->show_previous_observed_species;
        $userSettings['showOnlyCommonSpecies'] = $this->show_only_common_species;
        $userSettings['settingsSynchedAt'] = $this->settings_synched_at;
        $userSettings['share_data'] = $this->share_data;

        $speciesGroupsUsers = [];
        $spGroupsUsers = $this->speciesgroupsRecordingLevels()->get();
        $allIds = \App\Models\Speciesgroup::all()->pluck('id')->toArray();

        foreach($spGroupsUsers as $spgu)
        {
            $spguItem = [];
            $spguItem['speciesgroup_id'] = $spgu->speciesgroup_id;
            $spguItem['speciesgroup_name'] = $spgu->speciesgroup->name;
            $spguItem['recordinglevel_id'] = $spgu->recordinglevel_id;
            $spguItem['recordinglevel_name'] = $spgu->recordinglevel->name;
            $speciesGroupsUsers[$spgu->speciesgroup->name] = $spguItem;

            $allIds = array_diff($allIds, [$spgu->speciesgroup_id]); 
        }
        $notCountedRecordingLevel = \App\Models\RecordingLevel::where('name', 'none')->first();
        foreach($allIds as $theId)
        {
            $spgu = \App\Models\Speciesgroup::find($theId);
            $spguItem = [];
            $spguItem['speciesgroup_id'] = $spgu->id;
            $spguItem['speciesgroup_name'] = $spgu->speciesgroup->name;
            $spguItem['recordinglevel_id'] = $notCountedRecordingLevel->id;
            $spguItem['recordinglevel_name'] = $notCountedRecordingLevel->name;
            $speciesGroupsUsers[$spgu->name] = $spguItem;
        }

        $userSettings['speciesGroupsUsers'] = $speciesGroupsUsers;

        $theCountingMethods = $this->countingMethods()->get();
        $countingMethods=[];
        foreach($theCountingMethods as $cm)
        {
            $countingMethods[] = $cm->name;
        }
        $userSettings['countingMethods'] = $countingMethods;

        $retArr['userSettings'] = $userSettings;


        $allSpids = [];
        $theRegions = $this->regions()->get();
        foreach($theRegions as $reg)
        {
            $regions[] = $reg->name;
            $spids = $reg->species()->pluck('species.id');
            foreach($spids as $spid)
            {
                if (!array_key_exists($spid, $allSpids))
                {
                    $allSpids[] = $spid;
                }
            }
        }

        $regIds = $theRegions->pluck('id');
        $managementTypeIds = \App\Models\ManagementType_Regions::whereIn('region_id', $regIds)->pluck('managementtype_id')->unique();
        $landUseTypeIds = \App\Models\LanduseType_Regions::whereIn('region_id', $regIds)->pluck('landusetype_id')->unique();
        foreach($managementTypeIds as $mtid) 
        {
            $mt = \App\Models\ManagementType::find($mtid);
            $managementType = [];
            $managementType['id'] = $mt->id;
            $managementType['name'] = $mt->name;
            $managementType['description'] = $mt->description;
            $managementTypes[] = $managementType;
        }
        foreach($landUseTypeIds as $lutid)
        {
            $lt = \App\Models\LanduseType::find($lutid);
            $landuseType = [];
            $landuseType['id'] = $lt->id;
            $landuseType['name'] = $lt->name;
            $landuseType['description'] = $lt->description;
            $landuseTypes[] = $landuseType;
        }

        $retArr['regions'] = $regions;

        $theSpecies = \App\Models\Species::find($allSpids);
        $localNameName = $this->prefered_language . 'name';
        foreach($theSpecies as $sp)
        {
            $singleSp = [];
            $singleSp['id'] = $sp->id;
            $singleSp['taxon'] = $sp->taxon;
            $singleSp['genus'] = ucwords($sp->genus);
            $singleSp['speciesgroupId'] = $sp->speciesgroup_id;
            $singleSp['description'] = $sp->description;
            $singleSp['imageLocation'] = $sp->imagelocation;
            $singleSp['extrainfoLocation'] = $sp->extrainfolocation;
            $locNam = $sp->$localNameName;
            if ($locNam == "")
            {
                $locNam = $sp->enname;
            }
            $singleSp['localName'] = $locNam;
            $species[$sp->id] = $singleSp;
        }
        $theSpeciesGroups = \App\Models\Speciesgroup::all();
        foreach($theSpeciesGroups as $sg)
        {
            $singleSpeciesGroup = [];
            $singleSpeciesGroup['id'] = $sg->id;
            $singleSpeciesGroup['name'] = $sg->name;
            $singleSpeciesGroup['description'] = \App\Models\Species::find($sg->defaultspecies_id)->getName($this);
            $singleSpeciesGroup['userCanCount'] = $sg->usercancount;
            $singleSpeciesGroup['defaultSpeciesId'] = $sg->defaultspecies_id;
            $speciesGroups[$sg->id] = $singleSpeciesGroup;

            $defSp = \App\Models\Species::find($sg->defaultspecies_id);
            $singleSp = [];
            $singleSp['id'] = $defSp->id;
            $singleSp['taxon'] = $defSp->taxon;
            $singleSp['genus'] = ucwords($defSp->genus);
            $singleSp['speciesgroupId'] = $defSp->speciesgroup_id;
            $singleSp['description'] = $defSp->description;
            $singleSp['imageLocation'] = $defSp->imagelocation;
            $singleSp['extrainfoLocation'] = $defSp->extrainfolocation;
            $singleSp['localName'] = $defSp->$localNameName;
            $species[$defSp->id] = $singleSp;
        }

        $userMessages = $this->usersMessages()->where('senddate', '>', Carbon::now()->subMonths(2))->whereNull('receivedate')->get();
        foreach($userMessages as $um)
        {
            $theMessage = \App\Models\PushMessage::find($um->pushmessage_id);
            $singleMessage = [];
            $singleMessage['id'] = $theMessage->id;
            $singleMessage['senddate'] = $um->senddate;
            $singleMessage['receivedate'] = $um->receivedate;
            $singleMessage['regionId'] = $theMessage->region_id;
            $singleMessage['content'] = $theMessage->content;
            $singleMessage['header'] = $theMessage->header;
            $singleMessage['imagePrimary'] = $theMessage->image_primary;
            $singleMessage['imageSecondary'] = $theMessage->image_secondary;
            $messages[$theMessage->id] = $singleMessage;
        }

        $theTransects = $this->transects()->get();
        foreach($theTransects as $tr)
        {
            $singleTransect = [];
            $singleTransect['id'] = $tr->id;
            $singleTransect['name'] = $tr->name;

            $singleSections = [];
            $theSections = $tr->transectSections()->get();
            foreach($theSections as $sec)
            {
                $singleSec = [];
                $singleSec['id'] = $sec->id;
                $singleSec['name'] = $sec->name;
                $singleSec['sequence'] = $sec->sequence;
                $singleSec['geometry'] = $sec->location;
                $singleSections[$sec->id] = $singleSec;
            }
            $singleTransect['sections'] = $singleSections;
            $transects[] = $singleTransect;
        }

        $allKeys = \App\Models\Language::all();
   /*  //   $theLanguages = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'];
        $theLanguage = $this->prefered_language
        foreach($allKeys as $theKey)
        {
            $arrLine = [];
            foreach($theLanguages as $theLanguage)
            {
                $arrLine[$theLanguage] = $theKey->$theLanguage;
            }
            $lang[$theKey->key] = $arrLine;
        }
        */
        $langAvailable = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'];
        $theLanguage = $this->prefered_language;
        foreach($allKeys as $theKey)
        {
            $theValue = $theKey->$theLanguage;
            if (($theValue == null) || ($theValue == ""))
            {
                $theValue = $theKey->en;
            }
            $lang[$theKey->key] = $theValue;
        }

        $retArr['userSettings'] = $userSettings;
        $retArr['regions'] = $regions;
        $retArr['species'] = $species;
        $retArr['speciesGroups'] = $speciesGroups;
        $retArr['messages'] = $messages;
        $retArr['transects'] = $transects;
        $retArr['translations'] = $lang;
        $retArr['availableTranslations'] = $langAvailable;
        $retArr['managementTypes'] = $managementTypes;
        $retArr['landuseTypes'] = $landuseTypes;
     
        return json_encode($retArr);
    }
}
