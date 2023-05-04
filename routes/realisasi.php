<?php

use App\Http\Livewire\ObjekRealisasi\{ImportObjekRealisasi, ObjekRealisasiForm};
use App\Http\Livewire\Realisasi\{RealisasiForm, RealisasiFisikForm, RealisasiTabs};
use Illuminate\Support\Facades\Route;

Route::get('/realisasi', RealisasiTabs::class)->name('realisasi');
Route::get('/realisasi/{objekRealisasiId}/form/{id?}', RealisasiForm::class)->name('realisasi.form');
Route::get('/realisasi-fisik/{objekRealisasiId}/form/{id?}', RealisasiFisikForm::class)->name('realisasi-fisik.form');

Route::get('/objek-realisasi/import', ImportObjekRealisasi::class)->name('objek-realisasi.import');
Route::get('/objek-realisasi/form/{id?}', ObjekRealisasiForm::class)->name('objek-realisasi.form');
