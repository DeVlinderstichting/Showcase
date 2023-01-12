<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class GeneralPagesController extends Controller
{
    public function welcome()
    {
        return redirect()->route('news');
        //return view ('landingpage');
    }

    public function start()
    {
        return view('start');
    }

    public function test()
    {
        return view('countdown40_test');
        return view('gamification_test');
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
        Session::flush();
        //Auth::guard('user')->logout();
        Auth::logout();
        
     //   Request()->session()->invalidate();
     //   Request()->session()->regenerateToken();

       // dd(Auth::user());
        return redirect()->route('showLogin');

    }
}
