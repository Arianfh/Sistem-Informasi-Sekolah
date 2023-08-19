<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('kelas', [KelasController::class, 'index']);
Route::post('kelas/tambah', [KelasController::class, 'store']);
Route::get('kelas/tampil/{id}', [KelasController::class, 'show']);
Route::get('kelas/{id}/edit', [KelasController::class, 'edit']);
Route::put('kelas/{id}/edit', [KelasController::class, 'update']);

Route::get('siswa', [SiswaController::class, 'index']);
Route::post('siswa/tambah', [SiswaController::class, 'store']);
Route::get('siswa/tampil/{id}', [SiswaController::class, 'show']);

Route::get('mapel', [MataPelajaranController::class, 'index']);
Route::post('mapel/tambah', [MataPelajaranController::class, 'store']);
Route::get('mapel/tampil/{id}', [MataPelajaranController::class, 'show']);

Route::get('nilai', [NilaiController::class, 'index']);
Route::post('nilai/tambah', [NilaiController::class, 'store']);