<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'nilai';
    protected $guarded = ['_id'];
    protected $filable = [
        'siswa_id',
        'mapel_id',
        'latihan1',
        'latihan2',
        'latihan3',
        'latihan4',
        'ulangan_harian1',
        'ulangan_harian2',
        'ulangan_tengah_semester',
        'ulangan_akhir_semester'
    ];
    public $timestamps = false;

    /*public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', '_id');
    }*/

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id', '_id');
    }
}
