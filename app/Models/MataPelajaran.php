<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use jenssegers\Mongodb\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'mata_pelajaran';
    protected $guarded = ['_id'];
    protected $filable = [
        'nama_mapel',
        'guru_mapel'
    ];
    public $timestamps = false;

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mapel_id', '_id');
    }
}
