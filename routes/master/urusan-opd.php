<?php

use Illuminate\Support\Facades\Route;

Route::get('/master/urusan-opd', App\Http\Livewire\UrusanOpdTabs::class)->name('perangkat-daerah');
Route::get('/master/urusan-opd/urusan/form/{id?}', App\Http\Livewire\Urusan\UrusanForm::class)->name('urusan.form');
Route::get('/master/urusan-opd/bidang-urusan/{urusanId}/form/{id?}', App\Http\Livewire\BidangUrusan\BidangUrusanForm::class)->name('bidang-urusan.form');
Route::get('/master/urusan-opd/opd/{idBidangUrusan}/form/{id?}', App\Http\Livewire\Opd\OpdForm::class)->name('opd.form');
Route::get('/master/urusan-opd/sub-opd/{idOpd}/{idBidangUrusan}/form/{id?}', App\Http\Livewire\SubOpd\SubOpdForm::class)->name('sub-opd.form');
