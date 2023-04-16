<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HintController extends Controller
{
    public function hint()
    {
        $user = Auth::user();
        $teams = DB::table("teams")->get();
        $hints = DB::table("hints")->get();

        return view("HintsDashboard.hints", compact("user", "hints", "teams"));
    }

    public function hintHistory()
    {
        $histories = DB::table("history_hints")->orderBy("created_at", "desc")->paginate(10);

        return view("HintsDashboard.history", compact("histories"));
    }

    public function addHint(Request $request)
    {
        $idteams = $request['idteams'];
        $idhints = $request['idhints'];

        $team = DB::table("teams")->where("idteams", $idteams)->get();
        $namaHint = DB::table("hints")->where("idhints", $idhints)->value('name');

        //Cek koin
        if ($team[0]->koin > 100) {
            // Cek jika tim tersebut belum punya hint
            if (!DB::table("history_hints")->where("hints_idhints", $idhints)->where("teams_idteams", $idteams)->exists()) {

                //Keterangan
                $details = "Team " . $team[0]->namaTeam . " mendapat hint " . $namaHint;
                // $date = date("Y-m-d H:i:s");
                //Insert
                DB::table("history_hints")->insert([
                    "hints_idhints" => $idhints,
                    "teams_idteams" => $idteams,
                    "keterangan" => $details,
                ]);

                //Team membayar hint
                DB::table("teams")->where("idteams", $idteams)->update([
                    "koin" => DB::raw("`koin` - " . 200)
                ]);
            } else {
                $details = "Team " . $team[0]->namaTeam . " sudah memiliki hint " . $namaHint;
            }
        } else {
            $details = "Team " . $team[0]->namaTeam . " tidak memiliki koin yang cukup";
        }

        return response()->json(["status" => "success", "msg" => $details]);
    }

    public function playerHint()
    {
        $user = Auth::user();

        //Hint yang dimiliki oleh tim tersebut
        $hints = DB::table("hints as h")
            ->join('history_hints as hh', 'h.idhints', 'hh.hints_idhints')
            ->join('teams as t', 't.idteams', 'hh.teams_idteams')
            ->where('t.idteams', $user->teams_idteams)
            ->get();

        return view("HintsDashboard.playerHint", compact("hints"));
    }
}
