<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('siswa_id');
            $collection->foreignId('mapel_id');
            $collection->integer('latihan1')->nullable()->default(0);
            $collection->integer('latihan2')->nullable()->default(0);
            $collection->integer('latihan3')->nullable()->default(0);
            $collection->integer('latihan4')->nullable()->default(0);
            $collection->integer('ulangan_harian1')->nullable()->default(0);
            $collection->integer('ulangan_harian2')->nullable()->default(0);
            $collection->integer('ulangan_tengah_semester')->nullable()->default(0);
            $collection->integer('ulangan_akhir_semester')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};
