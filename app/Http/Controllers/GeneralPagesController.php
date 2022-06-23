<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GeneralPagesController extends Controller
{
    public function welcome()
    {
        return redirect()->route('news');
        //return view ('landingpage');
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
    public function showNews()
    {
        $newsItems = \App\Models\NewsItem::all();
        return view ('news', ['newsItems' => $newsItems]);
    }
    public function showNewsItem(\App\Models\NewsItem $newsItem)
    {
        return view ('newsItem', ['newsItem' => $newsItem]);
    }
    public function logoff()
    {
        Auth::logout();
        return redirect()->route('showLogin');
    }
}
