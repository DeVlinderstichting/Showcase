<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Visit;
use Auth;

class VisitController extends Controller
{
    public function visitIndex()
    {
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
        $title = 'Create a visit';
        return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $visitType, 'user' => $user, 'species' => $speciesList]);
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
            $countingMethodId = $visit->countingmethod_id;
            $title = 'Edit visit';
            return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $countingMethodId, 'user' => $user, 'species' => $speciesList]);
        }
    }
    public function visitStore($visit_id)
    {
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
        $rules['observations'] = ['required', 'array'];
        $rules['observations.*.number'] = ['required', 'integer', 'between:0,1001'];
        $rules['observations.*.species_id'] = ['required', 'exists:species,id'];

        if ($countType == 2)
        {
            $rules['wind'] = ['required', 'integer', 'between:0,8'];
            $rules['cloud'] = ['required', 'integer', 'between:0,8'];
            $rules['temp'] = ['required', 'integer', 'between:-10,60'];

        }

        $valDat = request()->validate($rules);
        [
         //   'track' => ['required', 'exists:locations,id'],
            'startdate' => ['required', 'date'], //:species_id,number'],
            
            'observations' => ['required', 'array'],
            
            'user_id' => ['required', 'exists:users,id'],
        ];


    }

    public function visitDelete(Visit $visit)
    {
        if ($this->userHasVisitRights($visit))
        {
            $visit->delete();
        }
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
}
