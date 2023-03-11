<?php

use Illuminate\Support\Facades\Route;

Route::get('/master/tahapan-apbd', App\Http\Livewire\TahapanApbd\TahapanApbdTable::class)->name('tahapan-apbd');
Route::get('/master/tahapan-apbd/form/{id?}', App\Http\Livewire\TahapanApbd\TahapanApbdForm::class)->name('tahapan-apbd.form');
