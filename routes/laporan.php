<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Livewire\CetakLaporanDeviasi;
use App\Http\Livewire\Laporan\{LaporanFormA, LaporanFormB, LaporanFormC, LaporanFormE};
use Illuminate\Support\Facades\Route;

Route::get('/laporan/cetak-deviasi', CetakLaporanDeviasi::class)->name('laporan-deviasi');
Route::get('/laporan/form-a', LaporanFormA::class)->name('laporan-form-a');
Route::get('/laporan/form-b', LaporanFormB::class)->name('laporan-form-b');
Route::get('/laporan/form-c', LaporanFormC::class)->name('laporan-form-c');
Route::get('/laporan/form-e', LaporanFormE::class)->name('laporan-form-e');
Route::post('/laporan/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
