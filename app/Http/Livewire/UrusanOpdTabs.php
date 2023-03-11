<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UrusanOpdTabs extends Component
{
    public string $tabAktif = 'urusan';

    protected $listeners = [
        'gantiTab' => 'gantiTab'
    ];

    public function gantiTab(string $namaTab)
    {
        $this->tabAktif = $namaTab;
    }

    public function render()
    {
        return view('livewire.urusan-opd-tabs');
    }
}
