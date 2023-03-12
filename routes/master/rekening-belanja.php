<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\AkunBelanja\AkunBelanjaForm;
use App\Http\Livewire\KelompokBelanja\KelompokBelanjaForm;
use App\Http\Livewire\JenisBelanja\JenisBelanjaForm;
use App\Http\Livewire\ObjekBelanja\ObjekBelanjaForm;
use App\Http\Livewire\RincianObjekBelanja\RincianObjekBelanjaForm;
use App\Http\Livewire\SubRincianObjekBelanja\SubRincianObjekBelanjaForm;

Route::get('/master/rekening-belanja', App\Http\Livewire\RekeningBelanjaTabs::class)->name('rekening');
Route::get('/master/rekening-belanja/akun/form/{id?}', AkunBelanjaForm::class)->name('akun.form');
Route::get('/master/rekening-belanja/kelompok/{idAkunBelanja}/form/{id?}', KelompokBelanjaForm::class)->name('kelompok.form');
Route::get('/master/rekening-belanja/jenis/{idKelompokBelanja}/form/{id?}', JenisBelanjaForm::class)->name('jenis.form');
Route::get('/master/rekening-belanja/objek/{idJenisBelanja}/form/{id?}', ObjekBelanjaForm::class)->name('objek.form');
Route::get('/master/rekening-belanja/rincian-objek/{idObjekBelanja}/form/{id?}', RincianObjekBelanjaForm::class)->name('rincian-objek.form');
Route::get('/master/rekening-belanja/sub-rincian-objek/{idRincianObjekBelanja}/form/{id?}', SubRincianObjekBelanjaForm::class)->name('sub-rincian-objek.form');
