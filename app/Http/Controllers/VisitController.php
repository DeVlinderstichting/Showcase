<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Visit;
use Illuminate\Support\Carbon;
use Auth;
use DB;

class VisitController extends Controller
{
    public function visitIndex()
    {
        $this->authenticateUser();
        $singleObsCountingMethodId = \App\Models\CountingMethod::where('name', 'single')->first()->id;
        $fitCountingMethodId = \App\Models\CountingMethod::where('name', 'fit')->first()->id;
        $timedCountingMethodId = \App\Models\CountingMethod::where('name', 'timed')->first()->id;
        $transectCountingMethodId = \App\Models\CountingMethod::where('name', 'transect')->first()->id;
        $user = Auth::user();
        $visits = $user->visits()->get();
        $singleObs = $user->visits()->where('countingmethod_id', $singleObsCountingMethodId)->get();
        $fit = $user->visits()->where('countingmethod_id', $fitCountingMethodId)->get();
        $timed = $user->visits()->where('countingmethod_id', $timedCountingMethodId)->get();
        $transect = $user->visits()->where('countingmethod_id', $transectCountingMethodId)->get();

        return view('visitIndex',['singleObservations' => $singleObs, 'fit' => $fit, 'timed' => $timed, 'transect' => $transect, 'user' => $user]);
    }

    public function visitShow(Visit $visit)
    {
        if ($this->userHasVisitRights($visit))
        {
            $user = Auth::user();
            return view ('visitShow', ['visit' => $visit, 'user' => $user]);
        }
    }
    
    public function visitCreate($visit_id = null, $visitType = 1)
    {
        $this->authenticateUser();
        $user = Auth::user();

        $visit=null;
        if (($visit_id!= null) && ($visit_id > 0))
        {
            $visit= \App\Models\Visit::find($visit_id);
        }
        if (!($this->userHasVisitRights($visit)))
        {
            $visit = null;
        }

        $minDate = date('Y-m-d', strtotime("2022-01-01"));
        $maxDate = date('Y-m-d');
        $speciesgroupsUser = \App\Models\SpeciesgroupsUsers::where('user_id', $user->id)->get();
        $speciesList = collect();
        foreach($speciesgroupsUser as $sg)
        {
            if(\App\Models\RecordingLevel::where('id', $sg->recordinglevel_id)->first()->name == 'species')
            {
                $selSpecies = \App\Models\Species::where('speciesgroup_id', $sg->speciesgroup_id)->where('taxrank', 'species')->get();
                $speciesList = $speciesList->merge($selSpecies);
            }
            if(\App\Models\RecordingLevel::where('id', $sg->recordinglevel_id)->first()->name == 'group')
            {
                $selSpecies = \App\Models\Species::where('speciesgroup_id', $sg->speciesgroup_id)->where('taxrank', 'speciesgroup')->get();
                $speciesList = $speciesList->merge($selSpecies);
            }
            // if(\App\Models\RecordingLevel::where('id', $sg->speciesgroup_id)->get()->text == 'none')
        }
        $regIds = $user->regions()->pluck('region_id');
        $plantSp = [];
        if ($visitType == 4)
        {
            $regSpecies = \App\Models\RegionsSpecies::whereIn('region_id', $regIds)->pluck('species_id');
            $plantsSpGroup = \App\Models\Speciesgroup::where('name', 'plants')->first();
            $plantSp = \App\Models\Species::whereIn('id', $regSpecies)->where('speciesgroup_id', $plantsSpGroup->id)->get();
        }
        $landUseTypeIds = \App\Models\LanduseType_Regions::whereIn('region_id', $regIds)->pluck('landusetype_id');
        $landuseTypes = \App\Models\LanduseType::whereIn('id', $landUseTypeIds)->get();
        $managementIds = \App\Models\ManagementType_Regions::whereIn('region_id', $regIds)->pluck('managementtype_id');
        $managementTypes = \App\Models\ManagementType::whereIn('id', $managementIds)->get();
        $title = 'create';
        return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $visitType, 'user' => $user, 'species' => $speciesList, 'plantSp' => $plantSp, 'landuseTypes' => $landuseTypes, 'managementTypes' => $managementTypes]);
    }

    public function visitEdit(Visit $visit)
    {
        if ($this->userHasVisitRights($visit))
        {
            $user = Auth::user();
            $minDate = date('Y-m-d', strtotime("2022-01-01"));
            $maxDate = date('Y-m-d');
            $speciesgroupsUser = \App\Models\SpeciesgroupsUsers::where('user_id', $user->id)->get();
            $speciesList = collect();
            foreach($speciesgroupsUser as $sg)
            {
                if(\App\Models\RecordingLevel::where('id', $sg->recordinglevel_id)->first()->name == 'species')
                {
                    $selSpecies = \App\Models\Species::where('speciesgroup_id', $sg->speciesgroup_id)->where('taxrank', 'species')->get();
                    $speciesList = $speciesList->merge($selSpecies);
                }
                if(\App\Models\RecordingLevel::where('id', $sg->recordinglevel_id)->first()->name == 'group')
                {
                    $selSpecies = \App\Models\Species::where('speciesgroup_id', $sg->speciesgroup_id)->where('taxrank', 'speciesgroup')->get();
                    $speciesList = $speciesList->merge($selSpecies);
                }
                // if(\App\Models\RecordingLevel::where('id', $sg->speciesgroup_id)->get()->text == 'none')

            }
            $regIds = $user->regions()->pluck('region_id');
            $plantSp = [];
            if ($visit->flower_id != null) //it is a fit count)
            {
                $regSpecies = \App\Models\RegionsSpecies::whereIn('region_id', $regIds)->pluck('species_id');
                $plantsSpGroup = \App\Models\Speciesgroup::where('name', 'plants')->first();
                $plantSp = \App\Models\Species::whereIn('id', $regSpecies)->where('speciesgroup_id', $plantsSpGroup->id)->get();
            }
            $landUseTypeIds = \App\Models\LanduseType_Regions::whereIn('region_id', $regIds)->pluck('landusetype_id');
            $landuseTypes = \App\Models\LanduseType::whereIn('id', $landUseTypeIds)->get();
            $managementIds = \App\Models\ManagementType_Regions::whereIn('region_id', $regIds)->pluck('managementtype_id');
            $managementTypes = \App\Models\ManagementType::whereIn('id', $managementIds)->get();

            $countingMethodId = $visit->countingmethod_id;
            $title = 'edit';
            return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $countingMethodId, 'user' => $user, 'species' => $speciesList, 'plantSp' => $plantSp, 'landuseTypes' => $landuseTypes, 'managementTypes' => $managementTypes]);
        }
    }

    public function visitStore($visit_id)
    {
        $this->authenticateUser();
        $user = Auth::user();

        if ($visit_id != null)
        {
            $visit = \App\Models\Visit::find($visit_id);
            if (!($this->userHasVisitRights($visit)))
            {
                return "user not authorized to edit visit";
            }
        }

        $firstValDat = request()->validate(['counttype' => ['required', 'in:1,2,3,4']]);
        $countType = ($firstValDat['counttype']);
        $rules = [];
        $rules['startdate'] = ['required', 'date'];
        $rules['enddate'] = ['required', 'date'];
        $rules['observations.*.number'] = ['required', 'integer', 'between:0,1001'];
        $rules['observations.*.species_id'] = ['required', 'exists:species,id'];
        $rules['recorders'] = ['nullable', 'integer'];
        $rules['notes'] = ['nullable', 'alpha_num_jsonarray'];
        $rules['region_id'] = ['nullable', 'exists:regions,id'];
        $rules['speciesgrouprecordinglevel'] = ['nullable', 'array'];
        $rules['landusetype_id'] = ['nullable', 'exists:landusetypes,id'];
        $rules['managementtype_id'] = ['nullable', 'exists:managementtypes,id'];

        if ($countType == 1)  // single observations require observations
        {
            $rules['observations'] = ['nullable', 'array', 'required']; 
        }
        else
        {
            $rules['observations'] = ['nullable', 'array'];
        }

        if ($countType == 2 || $countType == 3)
        {
            $rules['wind'] = ['required', 'integer', 'between:0,8'];
            $rules['cloud'] = ['required', 'integer', 'between:0,8'];
            $rules['temperature'] = ['required', 'integer', 'between:-10,60'];
        }
        if ($countType != 3) //not a transect so a geometry is required 
        {
            $rules['geometry'] = ['required'];
        }
        else 
        {
            $rules['transect_id'] = ['exists:transects,id'];
        }
        if ($countType == 4) // fit count, plant type is required 
        {
            $rules['flower_id'] = ['required', 'exists:species,id'];
            $rules['flowercount'] = ['required', 'integer', 'between:0,10000'];
        }

        $valDat = request()->validate($rules);

        if (!$visit)
        {
            $visit = new \App\Models\Visit();
        }

        $visit->countingmethod_id = $countType;

        if (array_key_exists('startdate', $valDat)) $visit->startdate = $valDat['startdate'];
        if (array_key_exists('enddate', $valDat)) $visit->enddate = $valDat['enddate'];
        $visit->sendtoserverdate = date("Y-m-d H:i:s");
        $visit->user_id = Auth::user()->id;

        if (array_key_exists('status', $valDat)) $visit->status = $valDat['status'];

        if (array_key_exists('recorders', $valDat)) $visit->recorders = $valDat['recorders'];
        if (array_key_exists('notes', $valDat)) $visit->notes = $valDat['notes'];
        if (array_key_exists('wind', $valDat)) $visit->wind = $valDat['wind'];
        if (array_key_exists('temperature', $valDat)) $visit->temperature = $valDat['temperature'];
        if (array_key_exists('cloud', $valDat)) $visit->cloud = $valDat['cloud'];
        if (array_key_exists('transect_id', $valDat)) $visit->transect_id = $valDat['transect_id'];
        if (array_key_exists('region_id', $valDat)) $visit->region_id = $valDat['region_id'];
        if (array_key_exists('landusetype_id', $valDat)) $visit->landusetype_id = $valDat['landusetype_id'];
        if (array_key_exists('managementtype_id', $valDat)) $visit->managementtype_id = $valDat['managementtype_id'];
        if (array_key_exists('flowercount', $valDat)) $visit->flowercount = $valDat['flowercount'];
        if (array_key_exists('flower_id', $valDat)) $visit->flower_id = $valDat['flower_id'];

        //  $visit->method_id = $this->getRecordingMethod($valDat['method'])->id;

        $speciesGroupRecordingLevels = [];

        if (array_key_exists('speciesgrouprecordinglevel', $valDat))
        {
            foreach( $valDat['speciesgrouprecordinglevel'] as $id)
            {
                $sgUser = \App\Models\SpeciesgroupsUsers::where(['user_id' => $user->id, 'speciesgroup_id' => $id])->first();
                $speciesGroupRecordingLevels[] = \App\Models\MethodSpeciesgroupRecordinglevel::firstOrNew(['speciesgroup_id' => $id, 'recordinglevel_id' => $sgUser->recordinglevel_id]);
            }
            $method = \App\Models\Method::getMethod($speciesGroupRecordingLevels);
            $visit->method_id = $method->id;
        }
        else //no method is present, which sucks -> assume single (or not)   
        {

        }
        

        if ($countType != 3) //not a transect so a geometry is required 
        {
            $visit->location = $valDat['geometry'];
        }
        $visit->save();

/*
        if (array_key_exists('location', $valDat))
        {
            if ($this->needsToBeStored($valDat['location']))
            {
                if (strlen($valDat['location']) > 10)
                {

                    $trackLine = '{"type":"MultiLineString","coordinates":[[';

                    $locPrepLine = str_replace('"', '', $valDat['location']);
                    $locPrepLine = str_replace('/', '', $locPrepLine);
                    $locPrepLine = str_replace('[', '', $locPrepLine);
                    $locPrepLine = str_replace(']', '', $locPrepLine);

                    $locItems = explode(",", $locPrepLine);
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
                    // \App\Models\IncomingDataBackup::create(['user_id' => $user->id, 'datapackage' => json_encode($locItems)]);
                    DB::statement($theSqlCommand);

                    //     $visit->location = $valDat['location'];
                    //{"type":"MultiLineString","coordinates":[[[4.689148782214867,51.79723317223025],[4.689197266129314,51.797421111800307],[4.689149999246926,51.79752350760841]]]}}

                    $allReg = \App\Models\Region::all();
                    foreach($allReg as $reg)
                    {
                        $sqRes = DB::select("SELECT ST_Intersects( (select location from regions where id = " . $reg->id . "), (select location from visits where id = " . $visit->id . ") ) as intersect");
                        if ($sqRes[0]->intersect != null)
                        {
                            $visit->region_id = $reg->id;
                            $visit->save();
                        }
                    }

                }
            }
        }
        */


        if (array_key_exists('observations', $valDat))
        {
            $observations = $valDat['observations'];

            foreach($observations as $obsDat)
            {
                $obsCarbonDate = Carbon::parse($obsDat['observationtime']);
                $obsSearchDate = $obsCarbonDate->format('Y-m-d H:i:s');
                $obsQ = \App\Models\Observation::where('visit_id', $visit->id)->where('species_id', $obsDat['species_id']);
                if ($obsDat['observationtime'] != '')
                {
                    $obsQ = $obsQ->where('observationtime', '=', $obsSearchDate);
                }
                if (array_key_exists('section', $obsDat))
                {
                    $obsQ = $obsQ->where('transect_section_id', $obsDat['section']);
                }
                $obs = $obsQ->first();

                if ($obs == null)
                {
                    $obs = new \App\Models\Observation();
                }

                $obs->species_id = $obsDat['species_id'];
                $obs->number = $obsDat['number'];
                $obs->visit_id = $visit->id;
                $obs->observationtime = $obsSearchDate;
                if ($countType != 3) //not a transect so a geometry is required 
                {
                    $obs->location = $valDat['geometry'];
                }
                else 
                {
                    if (array_key_exists('section', $obsDat)) 
                    {
                        $theTransectSection = \App\Models\TransectSections::find($obsDat['section']);
                        $obs->location = $theTransectSection->location;
                        $obs->transect_section_id = $obsDat['section'];
                    }
                }

              //  if (array_key_exists('transect_section_id', $obsDat)) {$visit->transect_section_id = 
              // $obsDat['transect_section_id'];}

                $obs->save();

                //{"type":"Point","coordinates":[6.196802769569339,52.87128883782826]}}
                //\DB::raw("ST_GeomFromGeoJSON('$geom')"
            //  $obs->location = "POINT(" . $obsDat['location'] . ")";
            //    $locItems = explode(",", $obsDat['location']);
             //   $insertLine = '{"type":"Point","coordinates":[' . $locItems[1] . "," . $locItems[2] . "]}";

              //  DB::statement("UPDATE observations set location = ST_GeomFromGeoJSON('$insertLine') where id = $obs->id");
            }
        }
        return redirect("/visit");
    }

    public function visitDelete(Visit $visit)
    {
        if ($this->userHasVisitRights($visit))
        {
            $visit->delete();
        }
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

    private function userHasVisitRights($visit = null)
    {
        $user = Auth::user();
        if ($user == null)
        {
            return false;
        }
        if ($visit != null)
        {
            if ($visit->user_id != $user->id)
            {
                return false;
            }
        }
        return true;
    }
    private function authenticateUser()
    {
        $user = Auth::user();
        if ($user == null)
        {
            return redirect()->route('showLogin');
        }
        return true;
    }
}
