<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Livewire\CetakLaporanDeviasi;
use App\Http\Livewire\Laporan\LaporanFormA;
use Illuminate\Support\Facades\Route;

Route::get('/laporan/cetak-deviasi', CetakLaporanDeviasi::class)->name('laporan-deviasi');
Route::get('/laporan/form-a', LaporanFormA::class)->name('laporan-form-a');
// Route::get('/laporan/form-a', LaporanFormA::class)->name('laporan-form-a');
Route::post('/laporan/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
