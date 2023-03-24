<?php

namespace App\Http\Livewire;

use App\Models\TahapanApbd;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PilihTahunAnggaran extends Component
{
    public $count = 0;

    public function pilihTahunAnggaran($idTahapan)
    {
        Cookie::queue(Cookie::forever("TAID", $idTahapan));
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $tahunAnggarans = collect(TahapanApbd::query()
            ->orderByDesc('tahun')
            ->get())->unique('tahun')->values()->all();

        return view('livewire.pilih-tahun-anggaran', compact('tahunAnggarans'))->layout('layouts.guest');
    }
}
