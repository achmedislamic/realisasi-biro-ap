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

    Route::get('/master/program', App\Http\Livewire\Program\ProgramTable::class)->name('program');
    Route::get('/master/program/form/{id?}', App\Http\Livewire\Program\ProgramForm::class)->name('program.form');

    Route::get('/realisasi/upload-program-kegiatan-subkegiatan', App\Http\Livewire\UploadProgramKegiatanSubkegiatan::class)->name('upload-program-kegiatan-subkegiatan');

    Route::get('/master/perankat-daerah', App\Http\Livewire\Urusan\UrusanTable::class)->name('perangkat-daerah');

    Route::get('/master/perankat-daerah/urusan/{id?}', App\Http\Livewire\Urusan\UrusanForm::class)->name('urusan.form');

    Route::get('/master/perankat-daerah/bidang-urusan/{urusanId}', App\Http\Livewire\BidangUrusan\BidangUrusanTable::class)->name('bidang-urusan');
    Route::get('/master/perankat-daerah/bidang-urusan/{urusanId}/form/{id?}', App\Http\Livewire\BidangUrusan\BidangUrusanForm::class)->name('bidang-urusan.form');

    Route::get('/master/perankat-daerah/opd/{idBidangUrusan}', App\Http\Livewire\Opd\OpdTable::class)->name('opd');
    Route::get('/master/perankat-daerah/opd/{idBidangUrusan}/form/{id?}', App\Http\Livewire\Opd\OpdForm::class)->name('opd.form');

    Route::get('/master/perankat-daerah/sub-unit/{idOpd}', App\Http\Livewire\SubUnit\SubUnitTable::class)->name('sub-unit');
    Route::get('/master/perankat-daerah/sub-unit/{idOpd}/form/{id?}', App\Http\Livewire\SubUnit\SubUnitForm::class)->name('sub-unit.form');
});

require __DIR__.'/auth.php';
