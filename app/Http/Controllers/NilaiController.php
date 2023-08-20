<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();
        return response()->json(['data' => $nilai], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'latihan1' => 'nullable|numeric',
            'latihan2' => 'nullable|numeric',
            'latihan3' => 'nullable|numeric',
            'latihan4' => 'nullable|numeric',
            'ulangan_harian1' => 'nullable|numeric',
            'ulangan_harian2' => 'nullable|numeric',
            'ulangan_tengah_semester' => 'nullable|numeric',
            'ulangan_akhir_semester' => 'nullable|numeric'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $nilai = Nilai::create([
                'siswa_id' => $request->siswa_id,
                'mapel_id' => $request->mapel_id,
                'latihan1' => $request->latihan1,
                'latihan2' => $request->latihan2,
                'latihan3' => $request->latihan3,
                'latihan4' => $request->latihan4,
                'ulangan_harian1' => $request->ulangan_harian1,
                'ulangan_harian2' => $request->ulangan_harian2,
                'ulangan_tengah_semester' => $request->ulangan_tengah_semester,
                'ulangan_akhir_semester' => $request->ulangan_akhir_semester
            ]);

            if ($nilai){
                return response()->json([
                    'message' => "Data berhasil disimpan",
                    'data' => $nilai
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Data tidak berhasil disimpan"
                ], 500);
            }
        }
    }
}
