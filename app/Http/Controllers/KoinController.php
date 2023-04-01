<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoinController extends Controller
{
    public function koin()
    {
        $teams = DB::table("teams")->get();

        $pattern = "/.{3}Koin\b/i";
        $success = preg_match($pattern, Request::url(), $match);
        $route = "/c1]2r'3iw[eop/dl";

        if ($success) {
            $route = $match[0];
        }

        echo $pattern, $success, $route;

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
