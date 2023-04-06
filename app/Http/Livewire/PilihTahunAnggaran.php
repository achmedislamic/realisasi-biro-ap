<?php

namespace App\Http\Livewire;

use App\Models\TahapanApbd;
use Livewire\Component;

class PilihTahunAnggaran extends Component
{
    public $count = 0;

    public function pilihTahunAnggaran($idTahapan)
    {
        cache()->forever('tahapanApbd', TahapanApbd::find($idTahapan));

        return to_route('dashboard');
    }

    public function render()
    {
        $tahunAnggarans = collect(TahapanApbd::query()
            ->orderByDesc('tahun')
            ->get())->unique('tahun')->values()->all();

        return view('livewire.pilih-tahun-anggaran', compact('tahunAnggarans'))->layout('layouts.guest');
    }
}
