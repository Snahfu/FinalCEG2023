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

    public function pengumpulanppt(Request $request)
    {
        $data = [];

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:ppt,pptx'
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
