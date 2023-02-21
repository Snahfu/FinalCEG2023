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
                $histories = DB::table("history")->where("tipe", "downgrade")->get();
                break;
            case "AdminBahan":
                $histories = DB::table("history")->where("tipe", "bahan")->get();
                break;
            case "DnC":
                $histories = DB::table("history")->where("tipe", "crafting")->orWhere("tipe", "dismantle")->get();
                break;
            case "Ingredient":
                $histories = DB::table("history")->where("tipe", "addIngredient")->get();
                break;
            case "Tool":
                $histories = DB::table("history")->where("tipe", "addTool")->get();
                break;
        }

        return view("history", compact("histories"));
    }
}
