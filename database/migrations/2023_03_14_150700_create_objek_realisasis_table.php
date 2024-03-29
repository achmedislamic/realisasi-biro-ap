<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objek_realisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahapan_apbd_id')->constrained();
            $table->foreignId('bidang_urusan_sub_opd_id')->constrained();
            $table->foreignId('sub_kegiatan_id')->constrained();
            $table->foreignId('sub_rincian_objek_belanja_id')->constrained();
            $table->unsignedDecimal('anggaran', 15)->default(0);
            $table->unsignedDecimal('target', 7)->nullable();
            $table->foreignId('satuan_id')->nullable()->constrained();
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
        Schema::dropIfExists('objek_ralisasis');
    }
};
