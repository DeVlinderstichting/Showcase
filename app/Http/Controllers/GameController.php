<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GameController extends Controller
{
    function getLandscapeAjax()
    {
        $valDat = request()->validate([
            'lon' => ['required', 'numeric', 'min:0', 'max:20'], 
            'lat' => ['required', 'numeric', 'min:45', 'max:60'],
        ]);

    //    $sqLine = "SELECT gv.val, gv.x, gv.y FROM landuse AS r CROSS JOIN LATERAL ST_PixelAsPolygons(rast, 1) AS gv WHERE ST_Intersects(rast, 1, ST_SetSRID(ST_MakePoint({$valDat['lon']}, {$valDat['lat']}),4326));";
        $sqLine = "select a.x, a.y, a.val as elev, b.val as landuse from (
                    SELECT gv.val, gv.x, gv.y FROM landuse AS r CROSS JOIN LATERAL ST_PixelAsPolygons(rast, 1) AS gv 
                    WHERE ST_Intersects(rast, 1, ST_SetSRID(ST_MakePoint({$valDat['lon']}, {$valDat['lat']}),4326))
                ) a 
                join (
                    SELECT gv.val, gv.x, gv.y FROM landuse AS r CROSS JOIN LATERAL ST_PixelAsPolygons(rast, 2) AS gv 
                    WHERE ST_Intersects(rast, 1, ST_SetSRID(ST_MakePoint({$valDat['lon']}, {$valDat['lat']}),4326))
                ) b
                on a.x = b.x and a.y = b.y;";
        $res = DB::select(DB::raw($sqLine));


        return $res;
    }
}
