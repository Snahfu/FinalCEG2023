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

        $inventory_bahan = DB::table('inventory')
            ->where('teams_idteams', $user->teams_idteams)
            ->whereIn('nama_barang', function ($query) {
                $query->select('nama_bahan')
                    ->from('bahan');
            })->get();

        $inventory_alat = DB::table('inventory')
            ->where('teams_idteams', $user->teams_idteams)
            ->whereIn('nama_barang', function ($query) {
                $query->select('nama_alat')
                    ->from('alat');
            })->get();
            
        // $inventory = array_merge($inventory_alat, $inventory_bahan);
        // dd($inventory);

        return view('pengumpulan', compact('inventory_bahan', 'inventory_alat'));
    }

    public function kumpul()
    {
    }
}
