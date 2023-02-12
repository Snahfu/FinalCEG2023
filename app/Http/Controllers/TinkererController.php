<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TinkererController extends Controller
{
    public function tinkerer()
    {
        $teams = DB::table("teams")->get();

        $alat = DB::table("alat")->get();

        $downgrade = [
            "Motor", "Pump", "Tub", "Pisau", "Gear", "Gauge", "Piston", "Cylinder", "Frame", "Screw",
            "Kaca", "Katup", "Kolom", "Kondensor", "Reboiler", "Klem", "Selang", "Drum", "Cover", "Nozzle",
            "Stirrer", "Bowl", "Beater", "Handle", "Tray", "Heater", "Blower", "Roller", "Chamber",
            "Exhaust System", "Cyclone", "Impeller", "Skirtboard", "Bucket", "Inlet"
        ];

        return view("CraftnDismantle.tinkerer", compact("alat", "downgrade", "teams"));
    }

    public function changeAlat(Request $request)
    {
        $idalat = $request->get("selectedAlat");
        $downgrade = DB::table("alat")->where("idalat", "=", $idalat)->select("downgrade")->get();
        $downgrade = explode(";", $downgrade[0]->downgrade);

        return response()->json(["data" => $downgrade]);
    }

    public function changeDowngrade(Request $request)
    {
        $downgrade_1 = $request->get("downgrade_1");
        $downgrade_2 = $request->get("downgrade_2");
        $downgrade_3 = $request->get("downgrade_3");

        $guess = ($downgrade_3 == "-") ? $downgrade_1 . ";" . $downgrade_2 : $downgrade_1 . ";" . $downgrade_2 . ";" . $downgrade_3;

        $alat = DB::table("alat")->where("downgrade", "=", $guess)->get();

        $count = $alat->count();

        return response()->json(["data" => $alat, "count" => $count]);
    }

    public function crafting(Request $request)
    {
        $alat = $request->get("alat");
        return response()->json(["status" => "success"]);
    }

    public function dismantle(Request $request)
    {
        $alat = $request->get("alat");
        return response()->json(["status" => "success"]);
    }
}
