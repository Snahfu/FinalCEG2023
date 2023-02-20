<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TinkererController extends Controller
{
    public function tinkerer()
    {
        $teams = DB::table("teams")->get();

        $alat = DB::table("alat")->get();

        $downgrade = [
            "Motor", "Pipe", "Tub", "Pisau", "Gear", "Gauge", "Piston", "Cylinder", "Frame", "Screw",
            "Kaca", "Katup", "Kolom", "Kondensor", "Reboiler", "Klem", "Selang", "Drum", "Cover", "Nozzle",
            "Stirrer", "Bowl", "Beater", "Handle", "Tray Plate", "Heater", "Roller", "Chamber", "Exhaust System",
            "Tower Cap", "Blower", "Cyclone", "Impeller", "Skirtboard", "Bucket", "Inlet", "Board", "Hinge",
            "Cooler", "Termometer", "Vent"
        ];

        return view("CraftnDismantle.tinkerer", compact("alat", "downgrade", "teams"));
    }

    public function changeAlat(Request $request)
    {
        $idalat = $request->get("selectedAlat");
        $downgrade = DB::table("alat")->where("idalat", "=", $idalat)->select("downgrade")->get();
        $downgrade = explode(";", $downgrade[0]->downgrade);

        return response()->json(["data" => $downgrade]);
    }

    public function changeDowngrade(Request $request)
    {
        $downgrade_1 = $request->get("downgrade_1");
        $downgrade_2 = $request->get("downgrade_2");
        $downgrade_3 = $request->get("downgrade_3");

        $guess = ($downgrade_3 == "-") ? $downgrade_1 . ";" . $downgrade_2 : $downgrade_1 . ";" . $downgrade_2 . ";" . $downgrade_3;

        $alat = DB::table("alat")->where("downgrade", "=", $guess)->get();

        $count = $alat->count();

        return response()->json(["data" => $alat, "count" => $count]);
    }

    public function crafting(Request $request)
    {
        $idteam = $request->get("team");
        $alat = $request->get("alat");

        $team = DB::table("teams")->select("namaTeam")->where("idteams", "=", $idteam)->get();

        $downgrade_1 = $request->get("downgrade_1");
        $downgrade_2 = $request->get("downgrade_2");
        $downgrade_3 = ($request->get("downgrade_3") == "-") ? "" : $request->get("downgrade_3");

        $downgrade = [$downgrade_1, $downgrade_2, $downgrade_3];

        $msg = "";
        // kalau semua downgrade ada
        if (
            DB::table("inventory")->where("nama_barang", "=", $downgrade_1)->where("teams_idteams", "=", $idteam)->exists() &&
            DB::table("inventory")->where("nama_barang", "=", $downgrade_2)->where("teams_idteams", "=", $idteam)->exists() &&
            (DB::table("inventory")->where("nama_barang", "=", $downgrade_3)->where("teams_idteams", "=", $idteam)->exists() ||
                $downgrade_3 == "")
        ) {
            // kurangi stock downgrade
            foreach ($downgrade as $dg) {
                DB::table("inventory")
                    ->where("nama_barang", "=", $dg)
                    ->where("teams_idteams", "=", $idteam)
                    ->update(["stock_barang" => DB::raw("`stock_barang`- 1")]);
            }

            // tambah stok barang yang di-crafting
            if (DB::table("inventory")->where("nama_barang", "=", $alat)->where("teams_idteams", "=", $idteam)->exists()) {
                DB::table("inventory")
                    ->where("nama_barang", "=", $alat)
                    ->where("teams_idteams", "=", $idteam)
                    ->update(["stock_barang" => DB::raw("`stock_barang` + 1")]);
            } else {
                DB::table("inventory")->insert([
                    "nama_barang" => $alat,
                    "stock_barang" => 1,
                    "teams_idteams" => $idteam
                ]);
            }

            // delete semua barang yang stock-nya 0
            DB::table("inventory")->where("stock_barang", "=", 0)->delete();

            // special case untuk alat dengan 2 downgrade
            $downgrade3 = ($downgrade_3 == "") ? "" : ", " . $downgrade_3;

            // tambahkan history
            $keterangan = "Team " . $team[0]->namaTeam . " Craft Alat (" . $alat . ") dengan Downgrade (" . $downgrade_1 . ", " . $downgrade_2 . $downgrade3 . ")";
            DB::table("history")->insert([
                "keterangan" => $keterangan,
                "tipe" => "crafting",
                "teams_idteams" => $idteam,
            ]);

            $msg = "Alat (" . $alat . ") berhasil di Crafting untuk team " . $team[0]->namaTeam;
        } else {
            $msg = "Downgrade tidak mencukupi untuk Crafting";
        }

        return response()->json(["status" => "success", "msg" => $msg]);
    }

    public function dismantle(Request $request)
    {
        $idteam = $request->get("team");
        $alat = $request->get("alat");

        $team = DB::table("teams")->select("namaTeam")->where("idteams", "=", $idteam)->get();

        $msg = "";
        // kalau alatnya ada
        if (DB::table("inventory")->where("nama_barang", "=", $alat)->where("teams_idteams", "=", $idteam)->exists()) {
            // kurangi stock alat
            DB::table("inventory")
                ->where("nama_barang", "=", $alat)
                ->where("teams_idteams", "=", $idteam)
                ->update(["stock_barang" => DB::raw("`stock_barang`- 1")]);

            $downgrade = DB::table("alat")->select("downgrade")->where("nama_alat", "=", $alat)->get();
            $downgrade = explode(";", $downgrade[0]->downgrade);

            // tambah downgrade ke inventory
            foreach ($downgrade as $dg) {
                if (DB::table("inventory")->where("nama_barang", "=", $dg)->where("teams_idteams", "=", $idteam)->exists()) {
                    DB::table("inventory")
                        ->where("nama_barang", "=", $dg)
                        ->where("teams_idteams", "=", $idteam)
                        ->update(["stock_barang" => DB::raw("`stock_barang` + 1")]);
                } else {
                    DB::table("inventory")->insert([
                        "nama_barang" => $dg,
                        "stock_barang" => 1,
                        "teams_idteams" => $idteam
                    ]);
                }
            }

            // delete semua barang yang stock-nya 0
            DB::table("inventory")->where("stock_barang", "=", 0)->delete();

            // special case alat dengan 2 downgrade
            $downgrade3 = (count($downgrade) == 2) ? "" : ", " . $downgrade[2];

            // tambahkan history
            $keterangan = "Team " . $team[0]->namaTeam . " Dismantle Alat (" . $alat . ") menjadi Downgrade (" . $downgrade[0] . ", " . $downgrade[1] . $downgrade3 . ")";
            DB::table("history")->insert([
                "keterangan" => $keterangan,
                "tipe" => "dismantle",
                "teams_idteams" => $idteam,
            ]);

            $msg = "Alat (" . $alat . ") berhasil di Dismantle menjadi Downgrade (" . $downgrade[0] . ", " . $downgrade[1] . $downgrade3 . ") untuk team " . $team[0]->namaTeam;
        } else {
            $msg = "Alat tidak mencukupi untuk Dismantle";
        }


        return response()->json(["status" => "success", "msg" => $msg]);
    }
}
