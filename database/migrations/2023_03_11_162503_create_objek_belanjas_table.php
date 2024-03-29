<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('objek_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_belanja_id')->constrained();
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
        Schema::dropIfExists('objek_belanjas');
    }
};
