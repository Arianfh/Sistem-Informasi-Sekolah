<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'kelas';
    protected $guarded = ['_id'];
    protected $filable = [
        'kelas',
        'wali_kelas'
    ];
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
