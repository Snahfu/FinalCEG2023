<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ToolsController extends Controller
{
    public function tools()
    {
        $user = Auth::user();
        $teams = DB::table("teams")->get();
        $alat = DB::table("alat")->get();

        return view("Pos.tools", compact("user", "teams", "alat"));
    }

    public function addTools(Request $request)
    {
        $idteams = $request['idteams'];
        $nama_alat = $request['nama_alat'];
        $jumlahAdd = $request["jumlahAdd"];

        $team = DB::table("teams")->where("idteams", $idteams)->get();

        // tambah bahan ke inventory pemain
        if (DB::table("inventory")->where("nama_barang", $nama_alat)->where("teams_idteams", $idteams)->exists()) {
            DB::table("inventory")
                ->where("nama_barang", $nama_alat)
                ->where("teams_idteams", $idteams)
                ->update([
                    "stock_barang" => DB::raw("stock_barang + " . $jumlahAdd),
                ]);
        } else {
            DB::table("inventory")->insert([
                "nama_barang" => $nama_alat,
                "stock_barang" => $jumlahAdd,
                "teams_idteams" => $idteams
            ]);
        }

        // buat keterangan
        $details = "Team " . $team[0]->namaTeam . " mendapat alat " . $nama_alat . " (" . $jumlahAdd . ")";
        //  masukin ke history
        DB::table("history")->insert([
            "keterangan" => $details,
            "tipe" => "addTool",
            "teams_idteams" => $idteams
        ]);

        return response()->json(["status" => "success", "msg" => $details]);
    }
}
