<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json(['data' => $siswa], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $siswa = Siswa::create([
                'nama' => $request->nama,
                'kelas_id' => $request->kelas_id
            ]);
            if ($siswa){
                return response()->json([
                    'message' => "Data berhasil disimpan",
                    'data' => $siswa
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Data tidak berhasil dihapus"
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       /* $siswa = Siswa::with('nilai.mataPelajaran')->where('_id', $id)->get();
        
        return response()->json([
            'data' => $siswa
        ], 200);*/

        $siswa = Siswa::where('_id', $id)->get();
        $nilai = Nilai::where('siswa_id', $id)->get();
        $nilai_akhir = [];

        foreach ($siswa as $sw){
            foreach ($nilai as $na){
                $nama = $na->mataPelajaran->nama_mapel;
                $guru = $na->mataPelajaran->guru_mapel;
                $latihan = 0.15 * (($na->latihan1 + $na->latihan2 + $na->latihan3 +$na->latihan4) / 4);
                $uh = 0.2 * (($na->ulangan_harian1 + $na->ulangan_harian) / 2);
                $uts = 0.25 * $na->ulangan_tengah_semester;
                $uas = 0.4 * $na->ulangan_akhir_semester;
                $hasil = $latihan + $uh + $uts +$uas;

                $detail = [
                    'id' => $na->id,
                    'nama_mapel' => $nama,
                    'guru_mapel' => $guru,
                    'nilai_latihan1' => $na->latihan1,
                    'nilai_latihan2' => $na->latihan2,
                    'nilai_latihan3' => $na->latihan3,
                    'nilai_latihan4' => $na->latihan4,
                    'nilai_ulangan1' => $na->ulangan_harian1,
                    'nilai_ulangan2' => $na->ulangan_harian2,
                    'nilai_ulangan_tengah_semester' => $na->ulangan_tengah_semester,
                    'nilai_ulangan_akhir_semester' => $na->ulangan_akhir_semester,
                    'hasil_akhir' => round($hasil, 2)
                ];

                array_push($nilai_akhir, $detail);
            }

            $detail_siswa = [
                'id' => $sw->_id,
                'nama' => $sw->nama,
                'kelas_id'=> $sw->kelas_id,
                'nilai' => $nilai_akhir
            ];
        }

        return response()->json([
            'data' => $detail_siswa
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
