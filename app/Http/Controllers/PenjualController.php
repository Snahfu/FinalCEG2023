<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PenjualController extends Controller
{
    public function penjualBahan()
    {
        $teams = DB::table("teams")->get();
        $market_bahan = DB::table("market_bahan")->where("sesi", "=", "1")->where("tipe", "=", "biasa")->get();

        return view("Penjual.bahan", compact("teams", "market_bahan"));
    }

    public function jualBahan(Request $request)
    {
        $idteams = $request["team"];
        $beliBahan = $request["beliBahan"];

        // hitung total harga
        $totHarga = 0;
        foreach ($beliBahan as $bahan) {
            $hargaSatuan = DB::table("market_bahan")->select("harga_beli")->where("bahan", "=", $bahan[0])->where("tipe", "=", "biasa")->get();
            $hargaSatuan = $hargaSatuan[0]->harga_beli;

            $totHarga += $bahan[1] * $hargaSatuan;
        }

        $team = DB::table("teams")->where("idteams", "=", $idteams)->get();
        $danaTeam = $team[0]->koin;

        // cek apakah koin team cukup
        if ($totHarga > $danaTeam) {
            return response()->json(["msg" => "koin yang team" . $team[0]->namaTeam . " miliki tidak mencukupi"]);
        }

        // team bayar penjual
        DB::table("teams")->where("idteams", "=", $idteams)->update([
            "koin" => DB::raw("`koin` - " . $totHarga)
        ]);

        foreach ($beliBahan as $bahan) {
            // kurangi stok penjual
            DB::table("market_bahan")->where("bahan", "=", $bahan[0])->update([
                "stok" => DB::raw("`stok` - " . $bahan[1]),
            ]);

            // tambah ke inventory
            DB::table("inventory")->insert([
                "nama_barang" => $bahan[0],
                "stock_barang" => $bahan[1],
                "teams_idteams" => $idteams,
            ]);
        }

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }

    public function penjualDowngrade()
    {
        $teams = DB::table("teams")->get();
        $market_downgrade = DB::table("market_downgrade")->where("sesi", "=", "1")->where("tipe", "=", "biasa")->get();

        return view("Penjual.downgrade", compact("teams", "market_downgrade"));
    }

    public function jualDowngrade(Request $request)
    {
        $idteams = $request["team"];
        $beliDowngrade = $request["beliDowngrade"];

        // hitung total harga
        $totHarga = 0;
        foreach ($beliDowngrade as $downgrade) {
            $hargaSatuan = DB::table("market_bahan")->select("harga_beli")->where("bahan", "=", $downgrade[0])->where("tipe", "=", "biasa")->get();
            $hargaSatuan = $hargaSatuan[0]->harga_beli;

            $totHarga += $downgrade[1] * $hargaSatuan;
        }

        $team = DB::table("teams")->where("idteams", "=", $idteams)->get();
        $danaTeam = $team[0]->koin;

        // cek apakah koin team cukup
        if ($totHarga > $danaTeam) {
            return response()->json(["msg" => "koin yang team" . $team[0]->namaTeam . " miliki tidak mencukupi"]);
        }

        // team bayar penjual
        DB::table("teams")->where("idteams", "=", $idteams)->update([
            "koin" => DB::raw("`koin` - " . $totHarga)
        ]);

        foreach ($beliDowngrade as $downgrade) {
            // kurangi stok penjual
            DB::table("market_bahan")->where("bahan", "=", $downgrade[0])->update([
                "stok" => DB::raw("`stok` - " . $downgrade[1]),
            ]);

            // tambah ke inventory
            DB::table("inventory")->insert([
                "nama_barang" => $downgrade[0],
                "stock_barang" => $downgrade[1],
                "teams_idteams" => $idteams,
            ]);
        }

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }
}
