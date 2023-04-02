<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KoinController extends Controller
{
    public function koin()
    {
        $teams = DB::table("teams")->get();

        // get this url
        $url = url()->full();

        // Regular Expression (RegEx) Pattern
        $pattern = "/.{3}Koin\b/i";

        // check if there is pattern in url and return 0 if false and 1 if true
        $success = preg_match($pattern, $url, $match);

        // error route
        $route = "/c1]2r'3iw[eop/dl";

        //  if true get the sub url
        if ($success) {
            $route = $match[0];
        }

        return view($route, compact("teams"));
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

    public function minKoin(Request $request)
    {
        $idteam = $request['idteam'];
        $jumlahKoin = $request['jumlahKoin'];

        $team = DB::table("teams")->where("idteams", $idteam)->get();

        DB::table("teams")->where("idteams", $idteam)->update([
            "koin" => DB::raw("`koin` - " . $jumlahKoin),
        ]);

        $detail = "Koin sejumlah " . $jumlahKoin . " berhasil ditarik dari " . $team[0]->namaTeam;

        return response()->json(["msg" => $detail]);
    }
}
