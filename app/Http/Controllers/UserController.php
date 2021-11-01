<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Auth;
use DB;

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
            $visit = \App\Models\Visit::where('startdate',$vDat['startdate'])->first();
            if ($visit == null)
            {
                $visit = new \App\Models\Visit();
            }

            $visit->countingmethod_id = $vDat['countingmethod_id'];

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

            if ($this->needsToBeStored($vDat['location']))
            {
                if (strlen($vDat['location']) > 10)
                {

                    $trackLine = '{"type":"MultiLineString","coordinates":[[';
                    $locItems = explode(",", $vDat['location']);
                    $i = 0;
                    while($i < count($locItems))
                    {
                        if ($i != 0)
                        {
                            $trackLine .= ",";
                        }
                        $trackLine .= "[" . $locItems[$i+2] . "," . $locItems[$i+1] . "]";
                        $i+=3;
                    }
                    $trackLine .= "]]}";
                    
                    
                    $theSqlCommand = "UPDATE visits set location = ST_GeomFromGeoJSON('$trackLine') where id = $visit->id";
                    \App\Models\IncomingDataBackup::create(['user_id' => $user->id, 'datapackage' => json_encode($locItems]));
                    DB::statement($theSqlCommand);

                    //     $visit->location = $vDat['location'];
                    //{"type":"MultiLineString","coordinates":[[[4.689148782214867,51.79723317223025],[4.689197266129314,51.797421111800307],[4.689149999246926,51.79752350760841]]]}}
                }
            }


            $observations = $vDat['observations'];

            foreach($observations as $obsDat)
            {
                $obs = \App\Models\Observation::where('visit_id', $visit->id)->where('species_id', $obsDat['species_id'])->first();
                if ($obs == null)
                {
                    $obs = new \App\Models\Observation();
                }

                $obs->species_id = $obsDat['species_id'];
                $obs->number = $obsDat['number'];
                $obs->visit_id = $visit->id;
                $obs->observationtime = $obsDat['observationtime'];
                if ($this->needsToBeStored($obsDat['transect_section_id'])) {$visit->transect_section_id = $obsDat['transect_section_id'];}
                $obs->save();

                //{"type":"Point","coordinates":[6.196802769569339,52.87128883782826]}}
                //\DB::raw("ST_GeomFromGeoJSON('$geom')"
              //  $obs->location = "POINT(" . $obsDat['location'] . ")";
                $locItems = explode(",", $obsDat['location']);
                $insertLine = '{"type":"Point","coordinates":[' . $locItems[1] . "," . $locItems[2] . "]}";

                DB::statement("UPDATE observations set location = ST_GeomFromGeoJSON('$insertLine') where id = $obs->id");
            }

         //   ST_GeomFromGeoJSON('{"type":"Point","coordinates":[-48.23456,20.12345]}')







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
            $stringSpGroupId = $item['speciesgroup_id'];
            $stringSpGroupId1 = str_replace("15mpost_checkSpeciesGroup_", "", $stringSpGroupId);
            $stringSpGroupId2 = str_replace("fit_checkSpeciesGroup_", "", $stringSpGroupId1);
            $stringSpGroupId3 = str_replace("transect_checkSpeciesGroup_", "", $stringSpGroupId2);
         //   $spGId = \App\Models\SpeciesGroup::where('id', )->first();

            $msg->speciesgroup_id = $stringSpGroupId3;
            $rLevel = \App\Models\RecordingLevel::where('name', 'none')->first();
            if (array_key_exists('recordinglevel_id', $item))
            {
                $rLevel = \App\Models\RecordingLevel::where('id', $item['recordinglevel_id'])->first();
            }
            elseif (array_key_exists('recordinglevel_name', $item))
            {
                $rLevel = \App\Models\RecordingLevel::where('name', $item['recordinglevel_name'])->first();
            }
            $msg->recordinglevel_id = $rLevel->id;
            $methodSpeciesGroups[] = $msg;
        }

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
                    if (($variable != -1) && ($variable != "-1"))
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
