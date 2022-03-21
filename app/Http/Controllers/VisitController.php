<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VisitController extends Controller
{
    public function VisitIndex()
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
}
