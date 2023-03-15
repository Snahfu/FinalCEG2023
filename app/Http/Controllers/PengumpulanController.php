<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PengumpulanController extends Controller
{
    public function webPage()
    {
        $user = Auth::user();

        $inventory = DB::table('inventory')->where('teams_idteams', $user->teams_idteams);

        return view('pengumpulan', compact('inventory'));
    }

    public function kumpul(){
        
    }
}
