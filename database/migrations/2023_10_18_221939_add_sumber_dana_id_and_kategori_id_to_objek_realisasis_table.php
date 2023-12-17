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
            $table->foreignId('sumber_dana_id')->nullable()->constrained()->after('satuan_id');
            $table->foreignId('kategori_id')->nullable()->constrained()->after('sumber_dana_id');
            $table->foreignId('anggota_dprd_id')->nullable()->constrained()->after('kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objek_realisasis', function (Blueprint $table) {
            $table->dropForeign('objek_realisasis_sumber_dana_id_foreign');
            $table->dropForeign('objek_realisasis_kategori_id_foreign');
            $table->dropColumn(['sumber_dana_id', 'kategori_id']);
        });
    }
};
