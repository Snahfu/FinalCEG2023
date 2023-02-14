<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ListDowngradeController extends Controller
{
    public function listDowngrade()
    {
        $alat = DB::table("alat")->get();
        return view("/listDowngrade", compact("alat"));
    }

    public function changeAlat(Request $request)
    {
        $idalat = $request->get("selectedAlat");
        $downgrade = DB::table("alat")->where("idalat", "=", $idalat)->select("downgrade")->get();
        $downgrade = explode(";", $downgrade[0]->downgrade);

        return response()->json(["data" => $downgrade]);
    }
}
