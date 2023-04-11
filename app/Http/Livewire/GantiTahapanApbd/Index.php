<?php

namespace App\Http\Livewire\GantiTahapanApbd;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $tahapanApbd = cache('tahapanApbd');

        return view('livewire.ganti-tahapan-apbd.index', compact('tahapanApbd'));
    }
}
