<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TinkererController extends Controller
{
    public function tinkerer()
    {
        $alat = DB::table("alat")->get();
        $downgrade = [
            "Motor", "Pump", "Tub", "Pisau", "Gear", "Gauge", "Piston", "Cylinder", "Frame", "Screw",
            "Kaca", "Katup", "Kolom", "Kondensor", "Reboiler", "Klem", "Selang", "Drum", "Cover", "Nozzle",
            "Stirrer", "Bowl", "Beater", "Handle", "Tray", "Heater", "Blower", "Roller", "Chamber",
            "Exhaust System", "Cyclone", "Impeller", "Skirtboard", "Bucket", "Inlet"
        ];
        return view("CraftnDismantle.tinkerer", compact("alat", "downgrade"));
    }

    public function changeAlat(Request $request)
    {
        $idalat = $request->get("selectedAlat");
        $downgrade = DB::table("alat")->where("idalat", "=", $idalat)->select("downgrade")->get();
        $downgrade = explode(";", $downgrade[0]->downgrade);

        return response()->json(["data" => $downgrade]);
    }
}
