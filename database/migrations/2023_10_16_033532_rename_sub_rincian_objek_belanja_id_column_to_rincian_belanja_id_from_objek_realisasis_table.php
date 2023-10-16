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
        Schema::table('objek_realisasis', function (Blueprint $table) {
            $table->renameColumn('sub_rincian_objek_belanja_id', 'rincian_belanja_id');

            $table->dropForeign('objek_realisasis_sub_rincian_objek_belanja_id_foreign');
            $table->foreign('rincian_belanja_id')->references('id')->on('rincian_belanjas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objek_realisasis', function (Blueprint $table) {
            $table->renameColumn('rincian_belanja_id', 'sub_rincian_objek_belanja_id');

            $table->dropForeign('objek_realisasis_rincian_belanja_id_foreign');
            $table->foreign('sub_rincian_objek_belanja_id')->references('id')->on('sub_rincian_objek_belanjas');
        });
    }
};
