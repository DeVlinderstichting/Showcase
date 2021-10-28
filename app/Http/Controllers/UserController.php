<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Auth;

//this controller is in charge of creating a package with all the user information, required to set up the app (the first time). This package should contain the species/settings/eba's etc 
class UserController extends Controller
{
    
    public function requestUserPackage()
    {
        $valDat = request()->validate([
            'username' => 'required',
            'password' => 'nullable',
            'accesstoken' => 'nullable',
            'datapackage' => 'nullable'
        ]);

    //    $user = \App\Models\User::find(1);
     //   $regions = $user->regions()->get();


        if ((array_key_exists('password', $valDat)) || (array_key_exists('accesstoken', $valDat)))
        {
            $authOk = false;
            //check password FIRST!! (the app can also send an empty accesstoken, with a password)
            if (array_key_exists('password', $valDat)) //do regular login 
            {
                if(auth()->attempt(array('email' => $valDat['username'], 'password' => $valDat['password']))) 
                {
                    $authOk = true;
                }
            }
            else //login using accesstoken 
            {
                if (strlen($valDat['accesstoken']) < 30) //check this because the first time a username+password and an empty accesstoken has to be accepted
                {
                    $authOk = false; //invalid accesstoken, we are done
                }
                else 
                {   
                    $theUser = \App\Models\User::where('email', $valDat['username'])->where('accesstoken', $valDat['accesstoken'])->first();
                    if ($theUser != null)
                    {
                        $authOk = true;
                        Auth::login($theUser);
                    }
                }
            }

            if ($authOk)
            {
                if (array_key_exists('datapackage', $valDat))
                {
                    $user = Auth::user();
                //    return gettype($valDat['datapackage']);
                 //   return 15;
                 
                  
            //      return $dat.usersettings;
               //   return $dataPackage['usersettings.userSettings.preferedLanguage;
                    $res = $this->processUserDataPackage($user, $valDat['datapackage']);
                    return $res;
                    return 19;
                }
                return Auth::user()->buildUserPackage();
            }
        }
        return "authentication failed";      
    }

    private function processUserDataPackage(User $user, $dataPackage)
    {
        \App\Models\IncomingDataBackup::create(['user_id' => $user->id, 'datapackage' => $dataPackage]);
        $dat = json_decode($dataPackage, true);
        $uSet = $dat['usersettings']['userSettings'];

        //first store user settings in case something changed 
        $user->prefered_language = $uSet['preferedLanguage'];
        $user->sci_names = $uSet['sci_names'];
        $user->show_only_common_species = $uSet['showOnlyCommonSpecies'];
        $user->show_previous_observed_species = $uSet['showPreviouslyObservedSpecies'];
        $user->settings_synched_at = date("Y-m-d H:i:s");
        $user->save();

        //store users speciesgroups 
        $spGroups = $uSet['speciesGroupsUsers'];
        foreach($spGroups as $spGroup)
        {
            $spgu = \App\Models\SpeciesgroupsUsers::where('user_id', $user->id)->where('speciesgroup_id', $spGroup['speciesgroup_id'])->first();
            if ($spgu == null)
            {
                $spgu = new \App\Models\SpeciesgroupsUsers();
                $spgu->user_id = $user->id; 
                $spgu->speciesgroup_id = $spGroup['speciesgroup_id'];
                $spgu->recordinglevel_id = $spGroup['recordinglevel_id'];
            }
            else 
            {
                $spgu->recordinglevel_id = $spGroup['recordinglevel_id'];
            }
            $spgu->save();
        }

        //store visit data 
        foreach ($dat['visitdata'] as $visitDat)
        {
            $vDat = $visitDat['data'];
            $visit = new \App\Models\Visit();
            $visit->countingmethod_id = $vDat['countingmethod_id'];
       //     $visit->location = $vDat['location'];
            //{"type":"MultiLineString","coordinates":[[[4.689148782214867,51.79723317223025],[4.689197266129314,51.797421111800307],[4.689149999246926,51.79752350760841]]]}}

            if ($this->needsToBeStored($vDat['startdate']))
            {
                $visit->startdate = $vDat['startdate'];
            }
            if ($this->needsToBeStored($vDat['enddate'])) {$visit->enddate = $vDat['enddate'];}
            $visit->sendtoserverdate = date("Y-m-d H:i:s");
            if ($this->needsToBeStored($vDat['status'])) {$visit->status = $vDat['status'];}
            if ($this->needsToBeStored($vDat['user_id'])) {$visit->user_id = $vDat['user_id'];}
            if ($this->needsToBeStored($vDat['recorders'])) {$visit->recorders = $vDat['recorders'];}
            if ($this->needsToBeStored($vDat['notes'])) {$visit->notes = $vDat['notes'];}
            if ($this->needsToBeStored($vDat['wind'])) {$visit->wind = $vDat['wind'];}
            if ($this->needsToBeStored($vDat['temperature'])) {$visit->temperature = $vDat['temperature'];}
            if ($this->needsToBeStored($vDat['cloud'])) {$visit->cloud = $vDat['cloud'];}
            if ($this->needsToBeStored($vDat['transect_id'])) {$visit->transect_id = $vDat['transect_id'];}
            if (array_key_exists('region_id', $vDat))
            {
                if ($this->needsToBeStored($vDat['region_id'])) {$visit->region_id = $vDat['region_id'];}
            }
            if ($this->needsToBeStored($vDat['flower_id'])) {$visit->flower_id = $vDat['flower_id'];}
            $visit->method_id = $this->getRecordingMethod($vDat['method'])->id;
            $visit->save();

            $observations = $vDat['observations'];
            foreach($observations as $obsDat)
            {
                $obs = new \App\Model\Observation();
                $obs->species_id = $obsDat['species_id'];
                $obs->number = $obsDat['number'];
                if ($this->needsToBeStored($vDat['transect_section_id'])) {$visit->transect_section_id = $vDat['transect_section_id'];}

                //{"type":"Point","coordinates":[6.196802769569339,52.87128883782826]}}
                //\DB::raw("ST_GeomFromGeoJSON('$geom')"
                $obs->location = "POINT(" . $obsDat['location'] . ")";
                $obs->observationtime = $obsDat['observationtime'];
            }
        }
    }

    private function getRecordingMethod($methodLine)
    {
        /*
            "method": 
            {
                "butterflies": {
                    "speciesgroup_id": 1,
                    "speciesgroup_name": "butterflies",
                    "recordinglevel_id": 1,
                    "recordinglevel_name": "species"
                }
            }
        */
        $methodSpeciesGroups = [];
        foreach($methodLine as $item)
        {
            $msg = new \App\Models\MethodSpeciesgroupRecordinglevel(); 
            $msg->speciesgroup_id = $item['speciesgroup_id'];
            $msg->recordinglevel_id = $item['recordinglevel_id'];
            $methodSpeciesGroups[] = $msg;
        }

        \App\Models\IncomingDataBackup::create(['user_id' => 1, 'datapackage' => json_encode($methodSpeciesGroups)]);

        return \App\Models\Method::getMethod($methodSpeciesGroups);
    }
    private function needsToBeStored($variable)
    {
        if ($variable != null)
        {
            if (!empty($variable))
            {
                if ($variable != "")
                {
                    return true;
                }
            }
        }
        return false;
    }
}
