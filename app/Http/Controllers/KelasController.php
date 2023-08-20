<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        return response()->json(['data' => $kelas], 200);
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
            'kelas' => 'required|string|max:10',
            'wali_kelas' => 'required|string|max:255'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $kelas = Kelas::create([
                'kelas' => $request->kelas,
                'wali_kelas' => $request->wali_kelas
            ]);
            if ($kelas){
                return response()->json([
                    'message' => "Data berhasil disimpan",
                    'data' => $kelas
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Data tidak berhasil disimpan"
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
        $kelas = Kelas::with('siswa')->where('_id', $id)->get();
    
        return response()->json([
            'data' => $kelas
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
        $kelas = Kelas::find($id);

        if ($kelas){
            return response()->json([
                'status' => 200,
                'data' => $kelas
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Data kelas tidak ditemukan"
            ], 404);
        }
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
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|string|max:10',
            'wali_kelas' => 'required|string|max:255'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $kelas = Kelas::find($id);

            if ($kelas){
                $kelas->update([
                    'kelas' => $request->kelas,
                    'wali_kelas' => $request->wali_kelas
                ]);

                return response()->json([
                    'message' => "Data berhasil diubah",
                    'data' => $kelas
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Data gagal diubah"
                ], 404);
            }
        }
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
