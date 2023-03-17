<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Events\Team;

class PenjualController extends Controller
{
    // Pemain Beli
    public function penjualBahanSell()
    {
        $tipe = "Sell";
        $teams = DB::table("teams")->get();
        $sesi = DB::table("sesi")->get();

        $market_bahan = DB::table("market_bahan")->where("sesi", $sesi[0]->sesi)->where("tipe", $sesi[0]->tipe)->get();

        // return view("Penjual.bahan", compact("teams", "market_bahan", "tipe"));
        return view("Penjual.bahan2", compact("teams", "market_bahan", "tipe"));
    }

    // Pemain Jual
    public function penjualBahanBuy()
    {
        $tipe = "Buy";
        $teams = DB::table("teams")->get();
        $sesi = DB::table("sesi")->get();

        $market_bahan = DB::table("market_bahan")->where("sesi", $sesi[0]->sesi)->where("tipe", $sesi[0]->tipe)->get();

        // return view("Penjual.bahan", compact("teams", "market_bahan", "tipe"));
        return view("Penjual.bahan2", compact("teams", "market_bahan", "tipe"));
    }

    // Pemain Beli
    public function jualBahan(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliBahan = $request["arrayBahan"];
        $sesi = DB::table("sesi")->get();

        // hitung total harga
        $totHarga = 0;
        foreach ($pemainBeliBahan as $bahan) {
            $hargaSatuan = DB::table("market_bahan")
                ->select("harga_beli")
                ->where("bahan", $bahan[0])
                ->where("sesi", $sesi[0]->sesi)
                ->where("tipe", $sesi[0]->tipe)
                ->get();
            $hargaSatuan = $hargaSatuan[0]->harga_beli;

            $totHarga += $bahan[1] * $hargaSatuan;
        }

        $team = DB::table("teams")->where("idteams", $idteams)->get();
        $danaTeam = $team[0]->koin;

        // cek apakah koin team cukup
        if ($totHarga > $danaTeam) {
            return response()->json(["msg" => "koin yang team" . $team[0]->namaTeam . " miliki tidak mencukupi"]);
        }

        // team bayar penjual
        DB::table("teams")->where("idteams", $idteams)->update([
            "koin" => DB::raw("`koin` - " . $totHarga)
        ]);

        $detail = "";
        foreach ($pemainBeliBahan as $bahan) {
            // kurangi stok penjual
            DB::table("market_bahan")
                ->where("bahan", $bahan[0])
                ->where("sesi", $sesi[0]->sesi)
                ->where("tipe", $sesi[0]->tipe)
                ->update([
                    "stok" => DB::raw("`stok` - " . $bahan[1]),
                ]);

            // tambah ke inventory
            if (DB::table("inventory")->where("nama_barang", $bahan[0])->where("teams_idteams", $idteams)->exists()) {
                DB::table("inventory")
                    ->where("nama_barang", $bahan[0])
                    ->where("teams_idteams", $idteams)
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

            if ($pemainBeliBahan[0][0] == $bahan[0]) {
                $detail = $bahan[0];
                $detail .= " ($bahan[1]) ";
            } else {
                $detail .= ", " . $bahan[0];
                $detail .= " ($bahan[1]) ";
            }
        }

        // tambah history
        $keterangan = "Team " . $team[0]->namaTeam . " Membeli Bahan (" . $detail . ")";
        DB::table("history")->insert([
            "keterangan" => $keterangan,
            "tipe" => "bahan",
            "teams_idteams" => $idteams,
        ]);

        // update koin di halaman user
        $updatedTeam = DB::table("teams")->where("idteams", $idteams)->get();
        $updatedKoin = $updatedTeam[0]->koin;

        event(new Team($idteams, $updatedKoin));

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }

    // Pemain Jual
    public function beliBahan(Request $request)
    {
        $idteams = $request["team"];
        $pemainJualBahan = $request["arrayBahan"];
        $sesi = DB::table("sesi")->get();

        $team = DB::table("teams")->where("idteams", $idteams)->get();

        // cek barang di inventory pemain
        $bahanLebih = [];
        $helper = true;
        foreach ($pemainJualBahan as $bahan) {
            // bahan tidak ada
            if (DB::table("inventory")->where("nama_barang", $bahan[0])->where("teams_idteams", $idteams)->doesntExist()) {
                array_push($bahanLebih, $bahan[0]);
                $helper = false;
            }
            // bahan ada tapi stok kurang
            else {
                $stokBahan = DB::table("inventory")->select("stock_barang")->where("nama_barang", $bahan[0])->where("teams_idteams", $idteams)->get();
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
            $hargaSatuan = DB::table("market_bahan")
                ->select("harga_jual")
                ->where("bahan", $bahan[0])
                ->where("sesi", $sesi[0]->sesi)
                ->where("tipe", $sesi[0]->tipe)
                ->get();
            $totHarga += $bahan[1] * $hargaSatuan[0]->harga_jual;

            // kurangi bahan di inventory
            DB::table("inventory")
                ->where("nama_barang", $bahan[0])
                ->where("teams_idteams", $idteams)
                ->update([
                    "stock_barang" => DB::raw("`stock_barang` - " . $bahan[1]),
                ]);

            // tambah bahan ke market
            DB::table('market_bahan')
                ->where("bahan", $bahan[0])
                ->where("sesi", $sesi[0]->sesi)
                ->where("tipe", $sesi[0]->tipe)
                ->update([
                    "stok" => DB::raw("`stok` + " . $bahan[1]),
                ]);
        }

        // uang diberikan ke team
        DB::table("teams")->where("idteams", $idteams)->update([
            "koin" => DB::raw("`koin` + " . $totHarga),
        ]);

        // delete semua barang yang stock-nya 0
        DB::table("inventory")->where("stock_barang", 0)->delete();

        $detail = "";
        foreach ($pemainJualBahan as $bahan) {
            if ($pemainJualBahan[0][0] == $bahan[0]) {
                $detail = $bahan[0];
                $detail .= " ($bahan[1]) ";
            } else {
                $detail .= ", " . $bahan[0];
                $detail .= " ($bahan[1]) ";
            }
        }

        // tambah history
        $keterangan = "Team " . $team[0]->namaTeam . " Menjual Bahan (" . $detail . ")";
        DB::table("history")->insert([
            "keterangan" => $keterangan,
            "tipe" => "bahan",
            "teams_idteams" => $idteams,
        ]);

        // update koin di halaman user
        $updatedTeam = DB::table("teams")->where("idteams", $idteams)->get();
        $updatedKoin = $updatedTeam[0]->koin;

        event(new Team($idteams, $updatedKoin));

        return response()->json(["status" => "success", "msg" => "Barang berhasil dijual"]);
    }

    // Pemain beli
    public function penjualDowngradeSell()
    {
        $tipe = "Sell";
        $teams = DB::table("teams")->get();
        $sesi = DB::table("sesi")->get();

        $market_downgrade = DB::table("market_downgrade")->where("tipe", $sesi[0]->tipe)->get();

        // return view("Penjual.downgrade", compact("teams", "market_downgrade", "tipe"));
        return view("Penjual.downgrade2", compact("teams", "market_downgrade", "tipe"));
    }

    // Pemain Jual
    public function penjualDowngradeBuy()
    {
        $tipe = "Buy";
        $teams = DB::table("teams")->get();
        $sesi = DB::table("sesi")->get();

        $market_downgrade = DB::table("market_downgrade")->where("tipe", $sesi[0]->tipe)->get();

        // return view("Penjual.downgrade", compact("teams", "market_downgrade", "tipe"));
        return view("Penjual.downgrade2", compact("teams", "market_downgrade", "tipe"));
    }

    // Pemain Beli
    public function jualDowngrade(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliDowngrade = $request["arrayDowngrade"];
        $sesi = DB::table("sesi")->get();

        // hitung total harga
        $totHarga = 0;
        foreach ($pemainBeliDowngrade as $downgrade) {
            $hargaSatuan = DB::table("market_downgrade")
                ->select("harga_beli")
                ->where("downgrade", $downgrade[0])
                ->where("tipe", $sesi[0]->tipe)
                ->get();

            $hargaSatuan = $hargaSatuan[0]->harga_beli;

            $totHarga += $downgrade[1] * $hargaSatuan;
        }

        $team = DB::table("teams")->where("idteams", $idteams)->get();
        $danaTeam = $team[0]->koin;

        // cek apakah koin team cukup
        if ($totHarga > $danaTeam) {
            return response()->json(["msg" => "koin yang team" . $team[0]->namaTeam . " miliki tidak mencukupi"]);
        }

        // team bayar penjual
        DB::table("teams")
            ->where("idteams", "=", $idteams)
            ->update([
                "koin" => DB::raw("`koin` - " . $totHarga)
            ]);

        $detail = "";
        foreach ($pemainBeliDowngrade as $downgrade) {
            // kurangi stok penjual
            DB::table("market_downgrade")
                ->where("downgrade", "=", $downgrade[0])
                ->where("tipe", $sesi[0]->tipe)
                ->update([
                    "stok" => DB::raw("`stok` - " . $downgrade[1]),
                ]);

            // tambah ke inventory pembeli
            if (DB::table("inventory")->where("nama_barang", $downgrade[0])->where("teams_idteams", $idteams)->exists()) {
                // kalau barang sudah ada langsung update
                DB::table("inventory")
                    ->where("nama_barang", $downgrade[0])
                    ->where("teams_idteams", $idteams)
                    ->update([
                        "stock_barang" => DB::raw("`stock_barang` + " . $downgrade[1]),
                    ]);
            } else {
                // kalau barang belum ada insert
                DB::table("inventory")->insert([
                    "nama_barang" => $downgrade[0],
                    "stock_barang" => $downgrade[1],
                    "teams_idteams" => $idteams,
                ]);
            }

            if ($pemainBeliDowngrade[0][0] == $downgrade[0]) {
                $detail = $downgrade[0];
            } else {
                $detail .= ", " . $downgrade[0];
            }
        }

        // buat keterangan history dan masukkan ke history
        $keterangan = "Team " . $team[0]->namaTeam . " Membeli Downgrade (" . $detail . ")";
        DB::table("history")->insert([
            "keterangan" => $keterangan,
            "tipe" => "downgrade",
            "teams_idteams" => $idteams,
        ]);

        // update koin di halaman user
        $updatedTeam = DB::table("teams")->where("idteams", $idteams)->get();
        $updatedKoin = $updatedTeam[0]->koin;

        event(new Team($idteams, $updatedKoin));

        return response()->json(["status" => "success", "msg" => "barang berhasil terbeli dan dikirimkan"]);
    }

    // Pemain Jual
    public function beliDowngrade(Request $request)
    {
        $idteams = $request["team"];
        $pemainBeliDowngrade = $request["arrayDowngrade"];
        $sesi = DB::table("sesi")->get();

        $team = DB::table("teams")->where("idteams", $idteams)->get();

        // cek barang di inventory pemain
        $downgradeLebih = [];
        $helper = true;
        foreach ($pemainBeliDowngrade as $downgrade) {
            // downgrade tidak ada
            if (DB::table("inventory")->where("nama_barang", $downgrade[0])->where("teams_idteams", $idteams)->doesntExist()) {
                array_push($downgradeLebih, $downgrade[0]);
                $helper = false;
            }
            // downgrade ada tapi stok kurang
            else {
                $stokDowngrade = DB::table("inventory")->select("stock_barang")->where("nama_barang", $downgrade[0])->where("teams_idteams", $idteams)->get();
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
            $hargaSatuan = DB::table("market_downgrade")
                ->select("harga_jual")
                ->where("downgrade", $downgrade[0])
                ->where("tipe", $sesi[0]->tipe)
                ->get();

            $totHarga += $downgrade[1] * $hargaSatuan[0]->harga_jual;

            // kurangi downgrade di inventory
            DB::table("inventory")
                ->where("nama_barang", "=", $downgrade[0])
                ->update([
                    "stock_barang" => DB::raw("`stock_barang` - " . $downgrade[1]),
                ]);

            // tambah downgrade ke market
            DB::table('market_downgrade')
                ->where("downgrade", $downgrade[0])
                ->where("tipe", $sesi[0]->tipe)
                ->update([
                    "stok" => DB::raw("`stok` + " . $downgrade[1]),
                ]);
        }

        // uang diberikan ke team
        DB::table("teams")->where("idteams", $idteams)->update([
            "koin" => DB::raw("`koin` + " . $totHarga),
        ]);

        // delete semua barang yang stock-nya 0
        DB::table("inventory")->where("stock_barang", 0)->delete();

        $detail = "";
        foreach ($pemainBeliDowngrade as $downgrade) {
            if ($pemainBeliDowngrade[0][0] == $downgrade[0]) {
                $detail = $downgrade[0];
            } else {
                $detail .= ", " . $downgrade[0];
            }
        }

        // tambah keterangan ke history
        $keterangan = "Team " . $team[0]->namaTeam . " Menjual Bahan (" . $detail . ")";
        DB::table("history")->insert([
            "keterangan" => $keterangan,
            "tipe" => "downgrade",
            "teams_idteams" => $idteams,
        ]);

        // update koin di halaman user
        $updatedTeam = DB::table("teams")->where("idteams", $idteams)->get();
        $updatedKoin = $updatedTeam[0]->koin;

        event(new Team($idteams, $updatedKoin));

        return response()->json(["status" => "success", "msg" => "Barang berhasil dijual"]);
    }
}
