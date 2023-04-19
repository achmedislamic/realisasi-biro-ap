<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rincian_masalahs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->foreignId('sub_opd_id')->constrained();
            $table->foreignId('sub_kegiatan_id')->constrained();
            $table->unsignedTinyInteger('triwulan'); //jika 0, maka tahunan
            $table->mediumText('kendala');
            $table->mediumText('tindak_lanjut');
            $table->mediumText('pihak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rincian_masalahs');
    }
};
