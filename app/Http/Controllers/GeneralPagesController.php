<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
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
       // return view('countdown40_test');
    /*    $rougly1Km = 0.01;

        $lat = 51.98258822621598;
        $lon = 5.682704182774078;


        $sqLine = "SELECT gv.val, gv.x, gv.y FROM landuse AS r CROSS JOIN LATERAL ST_PixelAsPolygons(rast) AS gv WHERE ST_Intersects(rast, 1, ST_SetSRID(ST_MakePoint($lon, $lat),4326));";
        $res = DB::select(DB::raw($sqLine));
        dd($res);

        $point = "ST_SetSRID(ST_MakePoint($lon, $lat),4326)";
        $poly = "ST_GeomFromText('LINESTRING(".$lon-$rougly1Km ." ". $lat-$rougly1Km.", ".$lon+$rougly1Km ." ". $lat-$rougly1Km.", ".$lon+$rougly1Km ." ". $lat+$rougly1Km.", ".$lon-$rougly1Km ." ". $lat+$rougly1Km.", ".$lon-$rougly1Km ." ". $lat-$rougly1Km.")')";

        dd("igo");
      //   51.98258822621598 5.682704182774078, 10 0, 10 10, 0 10, 51.98258822621598 5.682704182774078)";
        $res = DB::statement(DB::raw("SELECT  ST_Value(rast, {$point}) As pixelValue from landuse"));
        dd($res);
*/ 
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
