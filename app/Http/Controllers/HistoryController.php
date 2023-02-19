<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HistoryController extends Controller
{
    public function history()
    {
        $user = Auth::user();

        $histories = null;
        switch ($user->role) {
            case "Player":
                $histories = DB::table("history")->where("teams_idteams", $user->teams_idteams)->get();
                break;
            case "AdminDowngrade":
                $histories = DB::table("history")->where("tipe", "=", "downgrade")->get();
                break;
            case "AdminBahan":
                $histories = DB::table("history")->where("tipe", "bahan")->get();
                break;
            case "Tinkerer":
                $histories = DB::table("history")->where("tipe", "crafting")->orWhere("tipe", "=", "dismantle")->get();
                break;
        }

        return view("history", compact("histories"));
    }
}
