<?php

namespace App\Http\Livewire\GantiTahapanApbd;

use App\Models\TahapanApbd;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $tahapanApbd = TahapanApbd::find(Cookie::get('TAID'));
        return view('livewire.ganti-tahapan-apbd.index', compact('tahapanApbd'));
    }
}
