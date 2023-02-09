<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $alat = DB::table("alat as a")->join("jenisAlat as j", "a.jenis_idjenis", "=", "j.idjenis")->get();
        // dd($alat);
        return view("Dashboard.dashboard", compact("alat"));
    }

    public function getItems(Request $request)
    {
        $itemType = $request->get("tipe");
        $data = "";
        switch ($itemType) {
            case "alat":
                $data = DB::table("alat")->get();
                break;
            case "bahan":
                $data = DB::table("bahan")->get();

                break;
            case "downgrade":
                $data = [
                    "Motor", "Pump", "Tub", "Pisau", "Gear", "Gauge", "Piston", "Cylinder", "Frame", "Screw",
                    "Kaca", "Katup", "Kolom", "Kondensor", "Reboiler", "Klem", "Selang", "Drum", "Cover", "Nozzle",
                    "Stirrer", "Bowl", "Beater", "Handle", "Tray", "Heater", "Blower", "Roller", "Chamber",
                    "Exhaust System", "Cyclone", "Impeller", "Skirtboard", "Bucket", "Inlet"
                ];
                
                break;
        }
        // dd($alat);
        return response()->json(["data" => $data]);
    }
}
