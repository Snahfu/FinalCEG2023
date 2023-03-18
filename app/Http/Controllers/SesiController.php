<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Events\Sesi;

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
        $helper = false;
        switch ($command) {
            case "back":
                if ($sesiNow > 1) {
                    DB::table("sesi")->where("idsesi", 1)->update([
                        "sesi" => DB::raw("`sesi` - 1")
                    ]);

                    $msg = "Pindah ke sesi " . ($sesiNow - 1);
                    $helper = true;
                } else {
                    $msg = "SUDAH SESI 1 WOE GABISA NGURANG LAGI";
                }
                break;

            case "next":
                if ($sesiNow < 3) {
                    DB::table("sesi")->where("idsesi", 1)->update([
                        "sesi" => DB::raw("`sesi` + 1")
                    ]);

                    $msg = "Pindah ke sesi " . ($sesiNow + 1);
                    $helper = true;
                } else {
                    $msg = "SUDAH SESI 3 WOE GABISA NAMBAH LAGI";
                }
                break;

            case "biasa":
                DB::table("sesi")->where("idsesi", 1)->update([
                    "tipe" => "biasa",
                ]);

                $msg = "Sesi Biasa";
                $helper = true;
                break;

            case "flash":
                DB::table("sesi")->where("idsesi", 1)->update([
                    "tipe" => "flash sale",
                ]);

                $msg = "FLASH SALE!!";
                $helper = true;
                break;
        }

        $sesiBaru = DB::table("sesi")->get();

        if ($helper == true) {
            event(new Sesi($msg));
        }

        return response()->json(["data" => $sesiBaru, "msg" => $msg, "helper" => $helper]);
    }
}
