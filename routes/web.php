<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pengguna', App\Http\Livewire\PenggunaTable::class)->name('pengguna');
    Route::get('/pengguna/form/{id?}', App\Http\Livewire\PenggunaForm::class)->name('pengguna.form');

    Route::get('/tahapan-apbd', App\Http\Livewire\TahapanApbd\TahapanApbdTable::class)->name('tahapan-apbd');
    Route::get('/tahapan-apbd/form/{id?}', App\Http\Livewire\TahapanApbd\TahapanApbdForm::class)->name('tahapan-apbd.form');


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

    Route::get('/program', App\Http\Livewire\Program\ProgramTable::class)->name('program');
    Route::get('/program/form/{id?}', App\Http\Livewire\Program\ProgramForm::class)->name('program.form');

    Route::get('/realisasi/upload-program-kegiatan-subkegiatan', App\Http\Livewire\UploadProgramKegiatanSubkegiatan::class)->name('upload-program-kegiatan-subkegiatan');
});

require __DIR__.'/auth.php';
