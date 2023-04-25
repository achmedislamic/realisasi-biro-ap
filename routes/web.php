<?php

use App\Http\Controllers\{CetakLaporanDeviasiController, ProfileController};
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');

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

    require __DIR__.'/realisasi.php';
    require __DIR__.'/laporan.php';
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

    require __DIR__.'/master/index.php';
});

require __DIR__.'/auth.php';
