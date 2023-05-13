<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Laporan\LaporanDeviasi;
use App\Http\Livewire\Laporan\LaporanFormA;
use App\Http\Livewire\Laporan\LaporanFormB;
use App\Http\Livewire\Laporan\LaporanFormC;
use App\Http\Livewire\Laporan\LaporanFormE;
use App\Http\Livewire\ObjekRealisasi\ImportObjekRealisasi;
use App\Http\Livewire\ObjekRealisasi\ObjekRealisasiForm;
use App\Http\Livewire\Realisasi\RealisasiFisikForm;
use App\Http\Livewire\Realisasi\RealisasiForm;
use App\Http\Livewire\Realisasi\RealisasiTabs;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', \App\Http\Controllers\DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rincian-masalah/form/{subKegiatan}/{subOpd}', App\Http\Livewire\RincianMasalahForm::class)->name('rincian-masalah.form');

    Route::get('/ta', \App\Http\Controllers\PilihTahunAnggaranController::class)
        ->name('pilih-ta');

    Route::middleware('can:pengguna-menu')->group(function () {
        Route::get('/pengguna', App\Http\Livewire\PenggunaTable::class)->name('pengguna');
        Route::get('/pengguna/form/{id?}', App\Http\Livewire\PenggunaForm::class)->name('pengguna.form');
    });

    //realisasi
    Route::get('/realisasi', RealisasiTabs::class)->name('realisasi');
    Route::get('/realisasi/{objekRealisasiId}/form/{id?}', RealisasiForm::class)->name('realisasi.form');
    Route::get('/realisasi-fisik/{objekRealisasiId}/form/{id?}', RealisasiFisikForm::class)->name('realisasi-fisik.form');
    Route::get('/objek-realisasi/import', ImportObjekRealisasi::class)->name('objek-realisasi.import');
    Route::middleware('can:is-admin')->get('/objek-realisasi/form/{id?}', ObjekRealisasiForm::class)->name('objek-realisasi.form');

    Route::prefix('/laporan')->group(function () {
        Route::get('/deviasi', LaporanDeviasi::class)->name('laporan-deviasi');
        Route::get('/form-a', LaporanFormA::class)->name('laporan-form-a');
        Route::get('/form-b', LaporanFormB::class)->name('laporan-form-b');
        Route::get('/form-c', LaporanFormC::class)->name('laporan-form-c');
        Route::get('/form-e', LaporanFormE::class)->name('laporan-form-e');
        Route::post('/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/jadwal/form', App\Http\Livewire\JadwalForm::class)->name('jadwal.form');
    Route::get('/target/form/{opd}/{mode?}', App\Http\Livewire\TargetForm::class)->name('target.form');
    Route::get('/target', App\Http\Livewire\TargetTable::class)->name('target');

    Route::prefix('/master')->group(function () {
        Route::get('/pekerjaan', App\Http\Livewire\Pekerjaan\PekerjaanTable::class)->name('pekerjaan');
        Route::get('/pekerjaan/form/{id?}', App\Http\Livewire\Pekerjaan\PekerjaanForm::class)->name('pekerjaan.form');
        Route::get('/pekerjaan/form-upload', App\Http\Livewire\Pekerjaan\UploadExcel::class)->name('pekerjaan.form-upload');

        Route::get('/satuan', App\Http\Livewire\SatuanTable::class)->name('satuan');
        Route::get('/satuan/form/{id?}', App\Http\Livewire\SatuanForm::class)->name('satuan.form');

        Route::get('/rekening-belanja', App\Http\Livewire\RekeningBelanja\RekeningBelanjaTable::class)->name('rekening-belanja');
        Route::get('/rekening-belanja/form/{id?}', App\Http\Livewire\RekeningBelanja\RekeningBelanjaForm::class)->name('rekening-belanja.form');
        Route::get('/rekening-belanja/form-upload', App\Http\Livewire\RekeningBelanja\UploadExcel::class)->name('rekening-belanja.form-upload');

        Route::get('/anggota-dprd', App\Http\Livewire\AnggotaDprd\AnggotaDprdTable::class)->name('anggota-dprd');
        Route::get('/anggota-dprd/form/{id?}', App\Http\Livewire\AnggotaDprd\AnggotaDprdForm::class)->name('anggota-dprd.form');

        Route::get('/kategori', App\Http\Livewire\Kategori\KategoriTable::class)->name('kategori');
        Route::get('/kategori/form/{id?}', App\Http\Livewire\Kategori\KategoriForm::class)->name('kategori.form');
    });

    Route::prefix('/master')->group(function (){
        Route::prefix('/program-kegiatan')->group(function (){
            Route::get('', App\Http\Livewire\ProgramKegiatanTabs::class)->name('program-kegiatan');
            Route::get('/program/form/{id?}', App\Http\Livewire\Program\ProgramForm::class)->name('program.form');
            Route::get('/kegiatan/{idProgram}/form/{id?}', App\Http\Livewire\Kegiatan\KegiatanForm::class)->name('kegiatan.form');
            Route::get('/sub-kegiatan/{idKegiatan}/form/{id?}', App\Http\Livewire\SubKegiatan\SubKegiatanForm::class)->name('sub-kegiatan.form');
        });
    });

    require __DIR__.'/master/index.php';
});

require __DIR__.'/auth.php';
