<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('targetable_id')->nullable();
            $table->string('targetable_type', 20)->nullable();
            $table->year('tahun');
            $table->unsignedSmallInteger('bulan');
            $table->decimal('jumlah', 15);
            $table->timestamps();
        });
    }
};
