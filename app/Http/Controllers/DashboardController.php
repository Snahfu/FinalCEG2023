<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $team = DB::table("teams")->where("idteams", "=", $user->teams_idteams)->get();

        $inventory = DB::table("inventory")->where("teams_idteams", "=", $user->teams_idteams)->get();

        $alat = DB::table("alat as a")->join("jenisAlat as j", "a.jenis_idjenis", "=", "j.idjenis")->get();

        return view("Dashboard.dashboard", compact("alat", "team", "inventory"));
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

        return response()->json(["data" => $data]);
    }
}
