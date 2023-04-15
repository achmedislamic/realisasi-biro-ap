<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Livewire\CetakLaporanDeviasi;
use App\Http\Livewire\Laporan\LaporanFormB;
use App\Http\Livewire\Laporan\LaporanFormA;
use Illuminate\Support\Facades\Route;

Route::get('/laporan/cetak-deviasi', CetakLaporanDeviasi::class)->name('laporan-deviasi');
Route::get('/laporan/form-a', LaporanFormA::class)->name('laporan-form-a');
Route::get('/laporan/form-b', LaporanFormB::class)->name('laporan-form-b');
Route::post('/laporan/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
