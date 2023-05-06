<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained();
            $table->string('kode')->nullable();
            $table->string('nama');
            $table->string('nama_kepala')->nullable();
            $table->string('nip_kepala')->nullable();
            $table->boolean('is_biro')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_units');
    }
};
