<?php

namespace App\Http\Livewire\Realisasi;

use Livewire\Component;

class RealisasiTabs extends Component
{
    public string $tabAktif = 'objekRealisasi';

    protected $listeners = [
        'gantiTab' => 'gantiTab'
    ];

    public function gantiTab(string $namaTab)
    {
        $this->tabAktif = $namaTab;
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-tabs');
    }
}
