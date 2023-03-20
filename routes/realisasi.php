<?php

use App\Http\Livewire\Realisasi\ImportRealisasi;
use App\Http\Livewire\Realisasi\RealisasiForm;
use App\Http\Livewire\Realisasi\RealisasiTable;
use Illuminate\Support\Facades\Route;

Route::get('/realisasi', RealisasiTable::class)->name('realisasi');
Route::get('/realisasi/import', ImportRealisasi::class)->name('realisasi.import');
Route::get('/realisasi/form/{id?}', RealisasiForm::class)->name('realisasi.form');
