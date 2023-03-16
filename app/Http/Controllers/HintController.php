<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HintController extends Controller
{
    // Pemain Beli
    public function hint()
    {
        $user = Auth::user();
        $teams = DB::table("teams")->get();
        $hints = DB::table("hints")->get();

        return view("HintsDashboard.hints", compact("user", "hints", "teams"));
    }

    public function addHint(Request $request)
    {
        $idteams = $request['idteams'];
        $idhints = $request['idhints'];

        $team = DB::table("teams")->where("idteams", $idteams)->get();
        $namaHint = DB::table("hints")->where("idhints", $idhints)->value('name');

        // Cek jika tim tersebut belum punya hint
        if (!DB::table("history_hints")->where("hints_idhints", $idhints)->where("teams_idteams", $idteams)->exists()) {


            //Keterangan
            $details = "Team " . $team[0]->namaTeam . " mendapat hint " . $namaHint;

            //Insert
            DB::table("history_hints")->insert([
                "hints_idhints" => $idhints,
                "teams_idteams" => $idteams,
                "keterangan" => $details
            ]);    
        }
        else{
            $details = "Team " . $team[0]->namaTeam . " sudah memiliki hint " . $namaHint;
        }

        return response()->json(["status" => "success", "msg" => $details]);
    }
}
