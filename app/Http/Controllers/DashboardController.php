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

        $alat = DB::table("alat as a")->join("jenis_alat as j", "a.jenis_idjenis", "=", "j.idjenis")-> orderBy("nama_alat", "asc")->get();

        return view("Dashboard.dashboard", compact("alat", "team", "inventory"));
    }

    public function getItems(Request $request)
    {
        $user = Auth::user();

        $itemType = $request->get("tipe");

        $inventory = DB::table("inventory")->where("teams_idteams", "=", $user->teams_idteams)->get();

        $data = "";
        switch ($itemType) {
            case "alat":
                $data = DB::table("alat")->get();
                break;
            case "bahan":
                $data = DB::table("bahan")->orderBy("nama_bahan" , "asc")->get();
                break;
            case "downgrade":
                $data = [
                    "Motor", "Pipe", "Tub", "Pisau", "Gear", "Gauge", "Piston", "Cylinder", "Frame", "Screw",
                    "Kaca", "Katup", "Kolom", "Kondensor", "Reboiler", "Klem", "Selang", "Drum", "Cover", "Nozzle",
                    "Stirrer", "Bowl", "Beater", "Handle", "Tray Plate", "Heater", "Roller", "Chamber", "Exhaust System",
                    "Tower Cap", "Blower", "Cyclone", "Impeller", "Skirtboard", "Bucket", "Inlet", "Board", "Hinge",
                    "Cooler", "Termometer", "Vent"
                ];
                break;
        }

        return response()->json(["data" => $data, "inventory" => $inventory]);
    }

    public function koin()
    {
        $teams = DB::table("teams")->get();

        return view("addKoin", compact("teams"));
    }

    public function addKoin(Request $request)
    {
        $idteam = $request['idteam'];
        $jumlahKoin = $request['jumlahKoin'];

        $team = DB::table("teams")->where("idteams", $idteam)->get();

        DB::table("teams")->where("idteams", $idteam)->update([
            "koin" => DB::raw("`koin` + " . $jumlahKoin),
        ]);

        $detail = "Koin sejumlah " . $jumlahKoin . " berhasil ditambahkan ke " . $team[0]->namaTeam;

        return response()->json(["msg" => $detail]);
    }
}
