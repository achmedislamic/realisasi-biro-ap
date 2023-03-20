<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pengguna', App\Http\Livewire\PenggunaTable::class)->name('pengguna');
    Route::get('/pengguna/form/{id?}', App\Http\Livewire\PenggunaForm::class)->name('pengguna.form');

    Route::get('/master/pekerjaan', App\Http\Livewire\Pekerjaan\PekerjaanTable::class)->name('pekerjaan');
    Route::get('/master/pekerjaan/form/{id?}', App\Http\Livewire\Pekerjaan\PekerjaanForm::class)->name('pekerjaan.form');
    Route::get('/master/pekerjaan/form-upload', App\Http\Livewire\Pekerjaan\UploadExcel::class)->name('pekerjaan.form-upload');

    Route::get('/master/satuan', App\Http\Livewire\SatuanTable::class)->name('satuan');
    Route::get('/master/satuan/form/{id?}', App\Http\Livewire\SatuanForm::class)->name('satuan.form');

    Route::get('/master/rekening-belanja', App\Http\Livewire\RekeningBelanja\RekeningBelanjaTable::class)->name('rekening-belanja');
    Route::get('/master/rekening-belanja/form/{id?}', App\Http\Livewire\RekeningBelanja\RekeningBelanjaForm::class)->name('rekening-belanja.form');
    Route::get('/master/rekening-belanja/form-upload', App\Http\Livewire\RekeningBelanja\UploadExcel::class)->name('rekening-belanja.form-upload');

    Route::get('/master/anggota-dprd', App\Http\Livewire\AnggotaDprd\AnggotaDprdTable::class)->name('anggota-dprd');
    Route::get('/master/anggota-dprd/form/{id?}', App\Http\Livewire\AnggotaDprd\AnggotaDprdForm::class)->name('anggota-dprd.form');

    Route::get('/master/kategori', App\Http\Livewire\Kategori\KategoriTable::class)->name('kategori');
    Route::get('/master/kategori/form/{id?}', App\Http\Livewire\Kategori\KategoriForm::class)->name('kategori.form');

    require __DIR__.'/master/index.php';
    require __DIR__.'/realisasi.php';
});

require __DIR__.'/auth.php';
