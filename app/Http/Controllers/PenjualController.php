<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PenjualController extends Controller
{
    // Pemain Beli
    public function penjualBahanSell()
    {
        $tipe = "Sell";
        $teams = DB::table("teams")->get();
        $market_bahan = DB::table("market_bahan")->where("sesi", "=", "1")->where("tipe", "=", "biasa")->get();

        return view("Penjual.bahan", compact("teams", "market_bahan", "tipe"));
    }

    // Pemain Jual
    public function penjualBahanBuy()
    {
        $tipe = "Buy";
        $teams = DB::table("teams")->get();
        $market_bahan = DB::table("market_bahan")->where("sesi", "=", "1")->where("tipe", "=", "biasa")->get();

        return view("Penjual.bahan", compact("teams", "market_bahan", "tipe"));
    }

    // Pemain Beli
    public function jualBahan(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliBahan = $request["arrayBahan"];

        // hitung total harga
        $totHarga = 0;
        foreach ($pemainBeliBahan as $bahan) {
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

        foreach ($pemainBeliBahan as $bahan) {
            // kurangi stok penjual
            DB::table("market_bahan")->where("bahan", "=", $bahan[0])->update([
                "stok" => DB::raw("`stok` - " . $bahan[1]),
            ]);

            // tambah ke inventory
            if (DB::table("inventory")->where("nama_barang", "=", $bahan[0])->where("teams_idteams", "=", $idteams)->exists()) {
                DB::table("inventory")
                    ->where("nama_barang", "=", $bahan[0])
                    ->where("teams_idteams", "=", $idteams)
                    ->update([
                        "stock_barang" => DB::raw("`stock_barang` + " . $bahan[1]),
                    ]);
            } else {
                DB::table("inventory")->insert([
                    "nama_barang" => $bahan[0],
                    "stock_barang" => $bahan[1],
                    "teams_idteams" => $idteams,
                ]);
            }
        }

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }

    // Pemain Jual
    public function beliBahan(Request $request)
    {
        $idteams = $request["team"];
        $pemainJualBahan = $request["arrayBahan"];

        // cek barang di inventory pemain
        $bahanLebih = [];
        $helper = true;
        foreach ($pemainJualBahan as $bahan) {
            // bahan tidak ada
            if (DB::table("inventory")->where("nama_barang", "=", $bahan[0])->where("teams_idteams", "=", $idteams)->doesntExist()) {
                array_push($bahanLebih, $bahan[0]);
                $helper = false;
            }
            // bahan ada tapi stok kurang
            else {
                $stokBahan = DB::table("inventory")->select("stock_barang")->where("nama_barang", "=", $bahan[0])->where("teams_idteams", "=", $idteams)->get();
                $stokBahan = $stokBahan[0]->stock_barang;

                // stok inventory kurang
                if ($bahan[1] > $stokBahan) {
                    array_push($bahanLebih, $bahan[0]);
                    $helper = false;
                }
            }
        }

        // bahan kurang untuk dijual
        if ($helper == false) {
            return response()->json(["status" => "kurang", "msg" => "Jumlah bahan yang ingin dijual kelebihan", "bahanLebih" => $bahanLebih]);
        }

        // bahan cukup untuk dijual
        $totHarga = 0;
        foreach ($pemainJualBahan as $bahan) {
            // hitung harga jual
            $hargaSatuan = DB::table("market_bahan")->select("harga_jual")->where("bahan", "=", $bahan[0])->where("tipe", "=", "biasa")->get();
            $totHarga += $bahan[1] * $hargaSatuan[0]->harga_jual;

            // kurangi bahan di inventory
            DB::table("inventory")
                ->where("nama_barang", "=", $bahan[0])
                ->update([
                    "stock_barang" => DB::raw("`stock_barang` - " . $bahan[1]),
                ]);

            // tambah bahan ke market
            DB::table('market_bahan')
                ->where("bahan", "=", $bahan[0])
                ->update([
                    "stok" => DB::raw("`stok` + " . $bahan[1]),
                ]);
        }

        // uang diberikan ke team
        DB::table("teams")->where("idteams", "=", $idteams)->update([
            "koin" => DB::raw("`koin` + " . $totHarga),
        ]);

        // delete semua barang yang stock-nya 0
        DB::table("inventory")->where("stock_barang", "=", 0)->delete();

        return response()->json(["status" => "success", "msg" => "Barang berhasil dijual"]);
    }

    // Pemain beli
    public function penjualDowngradeSell()
    {
        $tipe = "Sell";
        $teams = DB::table("teams")->get();
        $market_downgrade = DB::table("market_downgrade")->where("tipe", "=", "biasa")->get();

        return view("Penjual.downgrade", compact("teams", "market_downgrade", "tipe"));
    }

    // Pemain Jual
    public function penjualDowngradeBuy()
    {
        $tipe = "Buy";
        $teams = DB::table("teams")->get();
        $market_downgrade = DB::table("market_downgrade")->where("tipe", "=", "biasa")->get();

        return view("Penjual.downgrade", compact("teams", "market_downgrade", "tipe"));
    }

    // Pemain Beli
    public function jualDowngrade(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliDowngrade = $request["arrayDowngrade"];

        // hitung total harga
        $totHarga = 0;
        foreach ($pemainBeliDowngrade as $downgrade) {
            $hargaSatuan = DB::table("market_downgrade")->select("harga_beli")->where("downgrade", "=", $downgrade[0])->where("tipe", "=", "biasa")->get();
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

        foreach ($pemainBeliDowngrade as $downgrade) {
            // kurangi stok penjual
            DB::table("market_downgrade")->where("downgrade", "=", $downgrade[0])->update([
                "stok" => DB::raw("`stok` - " . $downgrade[1]),
            ]);

            // tambah ke inventory
            if (DB::table("inventory")->where("nama_barang", "=", $downgrade[0])->where("teams_idteams", "=", $idteams)->exists()) {
                DB::table("inventory")
                    ->where("nama_barang", "=", $downgrade[0])
                    ->where("teams_idteams", "=", $idteams)
                    ->update([
                        "stock_barang" => DB::raw("`stock_barang` + " . $downgrade[1]),
                    ]);
            } else {
                DB::table("inventory")->insert([
                    "nama_barang" => $downgrade[0],
                    "stock_barang" => $downgrade[1],
                    "teams_idteams" => $idteams,
                ]);
            }
        }

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }

    // Pemain Jual
    public function beliDowngrade(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliDowngrade = $request["arrayDowngrade"];

        // cek barang di inventory pemain
        $downgradeLebih = [];
        $helper = true;
        foreach ($pemainBeliDowngrade as $downgrade) {
            // downgrade tidak ada
            if (DB::table("inventory")->where("nama_barang", "=", $downgrade[0])->where("teams_idteams", "=", $idteams)->doesntExist()) {
                array_push($downgradeLebih, $downgrade[0]);
                $helper = false;
            }
            // downgrade ada tapi stok kurang
            else {
                $stokDowngrade = DB::table("inventory")->select("stock_barang")->where("nama_barang", "=", $downgrade[0])->where("teams_idteams", "=", $idteams)->get();
                $stokDowngrade = $stokDowngrade[0]->stock_barang;

                // stok inventory kurang
                if ($downgrade[1] > $stokDowngrade) {
                    array_push($downgradeLebih, $downgrade[0]);
                    $helper = false;
                }
            }
        }

        // downgrade kurang untuk dijual
        if ($helper == false) {
            return response()->json(["status" => "kurang", "msg" => "Jumlah downgrade yang ingin dijual kelebihan", "downgradeLebih" => $downgradeLebih]);
        }

        // downgrade cukup untuk dijual
        $totHarga = 0;
        foreach ($pemainBeliDowngrade as $downgrade) {
            // hitung harga jual
            $hargaSatuan = DB::table("market_downgrade")->select("harga_jual")->where("downgrade", "=", $downgrade[0])->where("tipe", "=", "biasa")->get();
            $totHarga += $downgrade[1] * $hargaSatuan[0]->harga_jual;

            // kurangi downgrade di inventory
            DB::table("inventory")
                ->where("nama_barang", "=", $downgrade[0])
                ->update([
                    "stock_barang" => DB::raw("`stock_barang` - " . $downgrade[1]),
                ]);

            // tambah downgrade ke market
            DB::table('market_downgrade')
                ->where("downgrade", "=", $downgrade[0])
                ->update([
                    "stok" => DB::raw("`stok` + " . $downgrade[1]),
                ]);
        }

        // uang diberikan ke team
        DB::table("teams")->where("idteams", "=", $idteams)->update([
            "koin" => DB::raw("`koin` + " . $totHarga),
        ]);

        // delete semua barang yang stock-nya 0
        DB::table("inventory")->where("stock_barang", "=", 0)->delete();

        return response()->json(["status" => "success", "msg" => "Barang berhasil dijual"]);
    }
}
