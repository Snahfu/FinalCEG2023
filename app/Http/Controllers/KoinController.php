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

        $keterangan = $team[0]->namaTeam . " mendapatkan " . $jumlahKoin . " koin";

        DB::table("history_koins")->insert([
            "keterangan" => $keterangan,
            "jenis_pos" => "Pos Bonus",
            "teams_idteams" => $idteam,
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

        $keterangan = $team[0]->namaTeam . " menggunakan " . $jumlahKoin . " koin";

        DB::table("history_koins")->insert([
            "keterangan" => $keterangan,
            "jenis_pos" => "Pos Consultant",
            "teams_idteams" => $idteam,
        ]);

        $detail = "Koin sejumlah " . $jumlahKoin . " berhasil ditarik dari " . $team[0]->namaTeam;

        return response()->json(["msg" => $detail]);
    }

    public function koinHistory($jenispos)
    {
        if ($jenispos == "posbonus") {
            $histories = DB::table("history_koins")
                ->where("jenis_pos", "Pos Bonus")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $pos = "Pos Bonus";
        } elseif ($jenispos == "posconsultant") {
            $histories = DB::table("history_koins")
                ->where("jenis_pos", "Pos Consultant")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $pos = "Pos Consultant";
        }

        return view(
            "historykoins",
            [
                "histories" => $histories,
                "jenispos" => $pos
            ]
        );
    }
}
