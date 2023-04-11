<?php

namespace App\Http\Livewire\Realisasi;

use Livewire\Component;

class RealisasiTabs extends Component
{
    public string $tabAktif = 'objekRealisasi';

    public $objekRealisasiId;

    protected $queryString = ['tabAktif'];

    protected $listeners = [
        'gantiTab' => 'gantiTab',
    ];

    public function gantiTab(string $namaTab, $objekRealisasiId)
    {
        $this->tabAktif = $namaTab;
        $this->objekRealisasiId = $objekRealisasiId;
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-tabs');
    }
}
