<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IngredientsController extends Controller
{
    public function ingredients()
    {
        $teams = DB::table("teams")->get();
        $bahan = DB::table("bahan")->get();

        return view("Pos.ingredients", compact("teams", "bahan"));
    }

    public function addIngredients(Request $request)
    {
        $idteams = $request['idteams'];
        $nama_bahan = $request['nama_bahan'];
        $jumlahAdd = $request["jumlahAdd"];

        $team = DB::table("teams")->where("idteams", $idteams)->get();

        // tambah bahan ke inventory pemain
        if (DB::table("inventory")->where("nama_barang", $nama_bahan)->where("teams_idteams", $idteams)->exists()) {
            DB::table("inventory")
                ->where("nama_barang", $nama_bahan)
                ->where("teams_idteams", $idteams)
                ->update([
                    "stock_barang" => DB::raw("stock_barang + " . $jumlahAdd),
                ]);
        } else {
            DB::table("inventory")->insert([
                "nama_barang" => $nama_bahan,
                "stock_barang" => $jumlahAdd,
                "teams_idteams" => $idteams
            ]);
        }

        // buat keterangan
        $details = "Team " . $team[0]->namaTeam . " mendapat bahan " . $nama_bahan . " (" . $jumlahAdd . ")";
        //  masukin ke history
        // DB::table("history")->insert([
        //     "keterangan" => $details,
        //     "tipe" => "add",
        //     "teams_idteams" => $idteams
        // ]);

        return response()->json(["status" => "success", "msg" => $details]);
    }
}
