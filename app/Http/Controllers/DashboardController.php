<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $alat = DB::table("alat as a")->join("jenisAlat as j", "a.jenis_idjenis", "=", "j.idjenis")->get();
        // dd($alat);
        return view("Dashboard.dashboard", compact("alat"));
    }

    public function getItems(Request $request)
    {
        $itemType = $request->get("tipe");
        $data = "";
        switch ($itemType) {
            case "alat":
                $data = DB::table("alat")->get();
                break;
            case "bahan":
                $data = DB::table("bahan")->get();

                break;
            case "downgrade":
                $data = DB::table("downgrade")->groupBy("nama_downgrade")->orderBy("iddowngrade", "asc")->get();
                // dd($data);
                break;
        }
        // dd($alat);
        return response()->json(["data" => $data]);
    }
}
