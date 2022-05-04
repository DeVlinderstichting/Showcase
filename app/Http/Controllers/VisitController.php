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
        $user = Auth::user();
        return view ('visitShow', ['visit' => $visit, 'user' => $user]);
    }
    
    public function visitCreate($visit_id = null, $visitType = 1)
    {
        $user = Auth::user();
        $visit=null;
        if (($visit_id!= null) && ($visit_id > 0))
        {
            $visit= \App\Models\Visit::find($visit_id);
        }
        $minDate = date('Y-m-d', strtotime("2022-01-01"));
        $maxDate = date('Y-m-d');
        $speciesList = \App\Models\Species::all();
        $title = 'Create a visit';
        return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $visitType, 'user' => $user, 'species' => $speciesList]);
    }

    public function visitEdit(Visit $visit)
    {
        $user = Auth::user();
        $minDate = date('Y-m-d', strtotime("2022-01-01"));
        $maxDate = date('Y-m-d');
        $speciesList = \App\Models\Species::all();
        $countingMethodId = $visit->countingmethod_id;
        $title = 'Edit visit';
        return view ('visitCreate', ['title' => $title, 'minDate' => $minDate, 'maxDate' => $maxDate, 'visit'=>$visit, 'visitType' => $countingMethodId, 'user' => $user, 'species' => $speciesList]);
    }
}
