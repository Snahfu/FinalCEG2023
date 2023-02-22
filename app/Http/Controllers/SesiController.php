<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SesiController extends Controller
{
    public function sesi()
    {
        $sesi = DB::table("sesi")->get();

        return view("adminSesi", compact("sesi"));
    }

    public function gantiSesi(Request $request)
    {
        $command = $request['command'];

        $sesiNow = (int) $request['sesiNow'];

        $msg = "";
        switch ($command) {
            case "back":
                if ($sesiNow > 1) {
                    DB::table("sesi")->where("idsesi", 1)->update([
                        "sesi" => DB::raw("`sesi` - 1")
                    ]);

                } else {
                    $msg = "SUDAH SESI 1 WOE GABISA NGURANG LAGI";
                }
                break;

            case "next":
                if ($sesiNow < 3) {
                    DB::table("sesi")->where("idsesi", 1)->update([
                        "sesi" => DB::raw("`sesi` + 1")
                    ]);
                } else {
                    $msg = "SUDAH SESI 3 WOE GABISA NAMBAH LAGI";
                }
                break;

            case "biasa":
                DB::table("sesi")->where("idsesi", 1)->update([
                    "tipe" => "biasa",
                ]);
                break;

            case "flash":
                DB::table("sesi")->where("idsesi", 1)->update([
                    "tipe" => "flash sale",
                ]);

                $msg = "FLASH SALE";
                break;
        }

        $sesiBaru = DB::table("sesi")->get();

        return response()->json(["data" => $sesiBaru, "msg" => $msg]);
    }
}
