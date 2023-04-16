<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class PengumpulanController extends Controller
{
    public function pengumpulan()
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

    public function saveFlowsheet(Request $request)
    {
        $user = Auth::user();
        $itemMap = $request->get("itemMap");
        foreach ($itemMap as $item) {
            // cek apakah barang ada di database
            if (DB::table("inventory")->where("nama_barang", $item[0])->where("teams_idteams", $user->teams_idteams)->exists()) {
                // ambil banyak stok barang
                $amount = DB::table("inventory")
                    ->where("nama_barang", $item[0])
                    ->where("teams_idteams", $user->teams_idteams)
                    ->get();
                    
                // update stok kalau berbeda
                if ($amount[0]->stock_barang != $item[1]) {
                    DB::table("inventory")
                        ->where("nama_barang", $item[0])
                        ->where("teams_idteams", $user->teams_idteams)
                        ->update([
                            "stock_barang" => $item[1]
                        ]);
                }
            }
        }

        return response()->json(["status" => "success", "msg" => "Canvas Saved Successfully"]);
    }

    public function pengumpulanppt(Request $request)
    {
        $data = [];

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:ppt,pptx,png'
        ]);

        if ($validator->fails()) {
            $data['status'] = 'error';
            $data['msg'] = $validator->errors()->first('file');
        } else {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File location
            $location = 'files';

            // Upload file
            $file->move($location, $filename);

            // Response
            $data['status'] = 'success';
            $data['msg'] = 'Upload Successful';
        }

        return response()->json(['data' => $data]);
    }
}
