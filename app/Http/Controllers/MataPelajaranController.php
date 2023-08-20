<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mata_pelajaran = MataPelajaran::all();
        return response()->json(['data' => $mata_pelajaran], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string',
            'guru_mapel' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $mata_pelajaran = MataPelajaran::create([
                'nama_mapel' => $request->nama_mapel,
                'guru_mapel' => $request->guru_mapel
            ]);

            if ($mata_pelajaran){
                return response()->json([
                    'message' => "Data berhasil disimpan",
                    'data' => $mata_pelajaran
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Data tidak berhasil disimpan"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $mata_pelajaran = MataPelajaran::with('nilai')->where('_id', $id)->get();
    
        return response()->json([
            'data' => $mata_pelajaran
        ], 200);
    }
}
