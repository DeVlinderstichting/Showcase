<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use \App\Models\Region;

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
    public function regionPublicIndex()
    {
        $allEbas = \App\Models\Region::all();
        return view ('ebaIndex', ['allEbas' => $allEbas]);
    }
    public function regionPublicShow(Region $region)
    {
       // $sqLine = "select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from (select * from visits where region_id = $region->id) x where ST_Intersects ((select location from regions where id = $region->id), x.location)=true;";
        $sqLine = "select sum(enddate-startdate) as totalvisittime, sum(st_length(location)) as totalvisitlength from visits where ST_Intersects ((select location from regions where id = $region->id), visits.location)=true;";
        $sqSecondLine = "select species_id as spid, sum(number) as num from observations join visits on visits.id = visit_id where ST_Intersects ((select location from regions where id = $region->id), visits.location)=true group by species_id";

        $landuseTypeSql = "select landusetype_id, count(landusetype_id) as landscapecount from visits where ST_Intersects ((select location from regions where id = $region->id), visits.location)=true group by landusetype_id";
        $managementTypeSql = "select managementtype_id, count(managementtype_id) as managementcount from visits where ST_Intersects ((select location from regions where id = $region->id), visits.location)=true group by managementtype_id";
        $visitsPerYearSql = "select year, count(year) as countperyear from (select extract('year' from startdate) as year from visits where ST_Intersects ((select location from regions where id = $region->id), visits.location)=true) iglo group by year order by year";


        $res = DB::select(DB::raw($sqLine));
        $secondRes = DB::select(DB::raw($sqSecondLine));
        $landuseTypes = DB::select(DB::raw($landuseTypeSql));
        $managementTypes = DB::select(DB::raw($managementTypeSql));
        $visitsPerYear = DB::select(DB::raw($visitsPerYearSql));

        $totalSpNr = 0;
        $totalSpCount = 0;
        foreach($secondRes as $sr)
        {
            $totalSpNr+= $sr->num;
            $totalSpCount++;
        }

        //dd($res[0]->totalvisittime);

        return view ('ebaInfo', ['eba' => $region, 'totalVisitTime' => $res[0]->totalvisittime, 'totalVisitLength' => $res[0]->totalvisitlength, 'nrOfSpecies' => $totalSpCount, 'nrOfIndividuals' => $totalSpNr, 'countPerSpecies' => $secondRes, 'landuse' => $landuseTypes, 'management' => $managementTypes, 'visitsPerYear' => $visitsPerYear]);
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
