<?php

use App\Http\Controllers\Laporan\LaporanFormAController;
use App\Http\Livewire\Laporan\LaporanFormA;
use Illuminate\Support\Facades\Route;

Route::get('/laporan/form-a', [LaporanFormAController::class, 'index'])->name('laporan-form-a');
// Route::get('/laporan/form-a', LaporanFormA::class)->name('laporan-form-a');
Route::post('/laporan/form-a/export', [LaporanFormAController::class, 'export'])->name('laporan-form-a.export');
