<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AkunBelanja\AkunBelanjaForm;
use App\Http\Livewire\JenisBelanja\JenisBelanjaForm;
use App\Http\Livewire\KelompokBelanja\KelompokBelanjaForm;
use App\Http\Livewire\Laporan\{LaporanDeviasi, LaporanFormA, LaporanFormB, LaporanFormC, LaporanFormE, LaporanSemester};
use App\Http\Livewire\ObjekBelanja\ObjekBelanjaForm;
use App\Http\Livewire\ObjekRealisasi\{ImportObjekRealisasi, ObjekRealisasiForm};
use App\Http\Livewire\Realisasi\{RealisasiFisikForm, RealisasiForm, RealisasiTabs};
use App\Http\Livewire\RincianObjekBelanja\RincianObjekBelanjaForm;
use App\Http\Livewire\SubRincianObjekBelanja\SubRincianObjekBelanjaForm;
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
    });
    Route::get('/pengguna/form/{id?}', App\Http\Livewire\PenggunaForm::class)->name('pengguna.form');

    Route::get('/realisasi', RealisasiTabs::class)->name('realisasi');
    Route::get('/realisasi/{objekRealisasiId}/form/{id?}', RealisasiForm::class)->name('realisasi.form');
    Route::get('/realisasi-fisik/{objekRealisasiId}/form/{id?}', RealisasiFisikForm::class)->name('realisasi-fisik.form');
    Route::get('/objek-realisasi/import', ImportObjekRealisasi::class)->name('objek-realisasi.import');
    Route::get('/objek-realisasi/form/{id?}', ObjekRealisasiForm::class)->name('objek-realisasi.form');

    Route::prefix('/laporan')->group(function () {
        Route::middleware('can:is-admin')->get('/deviasi', LaporanDeviasi::class)->name('laporan-deviasi');
        Route::get('/form-a', LaporanFormA::class)->name('laporan-form-a');
        Route::get('/semester', LaporanSemester::class)->name('laporan-semester');
        Route::get('/form-b', LaporanFormB::class)->name('laporan-form-b');
        Route::get('/form-c', LaporanFormC::class)->name('laporan-form-c');
        Route::get('/form-e', LaporanFormE::class)->name('laporan-form-e');
        Route::post('/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
    });

    Route::prefix('/select')->group(function () {
        Route::get('/opd', App\Http\Controllers\Select\OpdController::class)->name('select.opd');
        Route::get('/sub-opd', App\Http\Controllers\Select\SubOpdController::class)->name('select.sub-opd');
        Route::get('/sub-rincian-objek-belanja', App\Http\Controllers\Select\SubRincianObjekBelanjaController::class)->name('select.sub-rincian-objek-belanja');
    });

});

Route::middleware(['auth', 'can:is-admin'])->group(function () {
    Route::get('/jadwal/form', App\Http\Livewire\JadwalForm::class)->name('jadwal.form');
    Route::get('/target/form/{opd}/{mode?}', App\Http\Livewire\TargetForm::class)->name('target.form');
    Route::get('/target', App\Http\Livewire\TargetTable::class)->name('target');

    Route::get('/tahapan-apbd', App\Http\Livewire\TahapanApbd\TahapanApbdTable::class)->name('tahapan-apbd');
    Route::get('/tahapan-apbd/form/{id?}', App\Http\Livewire\TahapanApbd\TahapanApbdForm::class)->name('tahapan-apbd.form');

    Route::prefix('/master')->group(function () {
        Route::get('/pekerjaan', App\Http\Livewire\Pekerjaan\PekerjaanTable::class)->name('pekerjaan');
        Route::get('/pekerjaan/form/{id?}', App\Http\Livewire\Pekerjaan\PekerjaanForm::class)->name('pekerjaan.form');
        Route::get('/pekerjaan/form-upload', App\Http\Livewire\Pekerjaan\UploadExcel::class)->name('pekerjaan.form-upload');

        Route::get('/satuan', App\Http\Livewire\Satuan\SatuanTable::class)->name('satuan');
        Route::get('/satuan/form/{id?}', App\Http\Livewire\Satuan\SatuanForm::class)->name('satuan.form');

        Route::get('/rekening-belanja', App\Http\Livewire\RekeningBelanja\RekeningBelanjaTable::class)->name('rekening-belanja');
        Route::get('/rekening-belanja/form/{id?}', App\Http\Livewire\RekeningBelanja\RekeningBelanjaForm::class)->name('rekening-belanja.form');
        Route::get('/rekening-belanja/form-upload', App\Http\Livewire\RekeningBelanja\UploadExcel::class)->name('rekening-belanja.form-upload');

        Route::get('/anggota-dprd', App\Http\Livewire\AnggotaDprd\AnggotaDprdTable::class)->name('anggota-dprd');
        Route::get('/anggota-dprd/form/{id?}', App\Http\Livewire\AnggotaDprd\AnggotaDprdForm::class)->name('anggota-dprd.form');

        Route::get('/kategori', App\Http\Livewire\Kategori\KategoriTable::class)->name('kategori');
        Route::get('/kategori/form/{id?}', App\Http\Livewire\Kategori\KategoriForm::class)->name('kategori.form');

        Route::prefix('/program-kegiatan')->group(function () {
            Route::get('', App\Http\Livewire\ProgramKegiatanTabs::class)->name('program-kegiatan');
            Route::middleware('can:crud-program')->get('/program/form/{id?}', App\Http\Livewire\Program\ProgramForm::class)->name('program.form');
            Route::get('/kegiatan/{idProgram}/form/{id?}', App\Http\Livewire\Kegiatan\KegiatanForm::class)->name('kegiatan.form');
            Route::get('/sub-kegiatan/{idKegiatan}/form/{id?}', App\Http\Livewire\SubKegiatan\SubKegiatanForm::class)->name('sub-kegiatan.form');
        });

        Route::prefix('/rekening-belanja')->group(function () {
            Route::get('/', App\Http\Livewire\RekeningBelanjaTabs::class)->name('rekening');
            Route::get('/akun/form/{id?}', AkunBelanjaForm::class)->name('akun.form');
            Route::get('/kelompok/{idAkunBelanja}/form/{id?}', KelompokBelanjaForm::class)->name('kelompok.form');
            Route::get('/jenis/{idKelompokBelanja}/form/{id?}', JenisBelanjaForm::class)->name('jenis.form');
            Route::get('/objek/{idJenisBelanja}/form/{id?}', ObjekBelanjaForm::class)->name('objek.form');
            Route::get('/rincian-objek/{idObjekBelanja}/form/{id?}', RincianObjekBelanjaForm::class)->name('rincian-objek.form');
            Route::get('/sub-rincian-objek/{idRincianObjekBelanja}/form/{id?}', SubRincianObjekBelanjaForm::class)->name('sub-rincian-objek.form');
        });

        Route::prefix('/urusan-opd')->group(function () {
            Route::get('/', App\Http\Livewire\UrusanOpdTabs::class)->name('perangkat-daerah');
            Route::get('/opd', App\Http\Livewire\UrusanOpdTabs::class)->name('master.informasi-perangkat-daerah');
            Route::get('/urusan/form/{id?}', App\Http\Livewire\Urusan\UrusanForm::class)->name('urusan.form');
            Route::get('/bidang-urusan/{urusanId}/form/{id?}', App\Http\Livewire\BidangUrusan\BidangUrusanForm::class)->name('bidang-urusan.form');
            Route::get('/opd/{idBidangUrusan}/form/{id?}', App\Http\Livewire\Opd\OpdForm::class)->name('opd.form');
            Route::get('/sub-opd/{idOpd}/{idBidangUrusan}/form/{id?}', App\Http\Livewire\SubOpd\SubOpdForm::class)->name('sub-opd.form');
        });
    });
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});
