<?php

use Illuminate\Support\Facades\Route;

Route::get('/master/program-kegiatan', App\Http\Livewire\ProgramKegiatanTabs::class)->name('program-kegiatan');
Route::get('/master/program-kegiatan/program/form/{id?}', App\Http\Livewire\Program\ProgramForm::class)->name('program.form');
Route::get('/master/program-kegiatan/kegiatan/{idProgram}/form/{id?}', App\Http\Livewire\Kegiatan\KegiatanForm::class)->name('kegiatan.form');
Route::get('/master/program-kegiatan/sub-kegiatan/{idKegiatan}/form/{id?}', App\Http\Livewire\SubKegiatan\SubKegiatanForm::class)->name('sub-kegiatan.form');
