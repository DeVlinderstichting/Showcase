<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralPagesController extends Controller
{
    public function welcome()
    {
        return view ('landingpage');
    }

    public function showIdHelp()
    {
        $idhelps = \App\Models\Region::all()->pluck('species_id_help');
        return view ('speciesIdentificationHelp', ['idHelps' => $idhelps]);
    }
    public function showProjectInfo()
    {
        return view ('projectInfo');
    }
    public function showRecordingMethodExplanation()
    {
        return view ('recordingMethodExplanation');
    }
}