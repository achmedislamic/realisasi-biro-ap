<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rincian_objek_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objek_belanja_id')->constrained();
            $table->string('kode');
            $table->string('nama', 500);
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
        Schema::dropIfExists('rincian_objek_belanjas');
    }
};
