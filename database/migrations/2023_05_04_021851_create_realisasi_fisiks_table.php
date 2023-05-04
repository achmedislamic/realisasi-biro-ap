<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('realisasi_fisiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objek_realisasi_id')->constrained();
            $table->date('tanggal');
            $table->unsignedDecimal('jumlah', 7)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_fisiks');
    }
};
