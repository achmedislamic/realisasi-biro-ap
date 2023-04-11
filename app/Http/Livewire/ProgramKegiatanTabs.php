<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProgramKegiatanTabs extends Component
{
    public string $proKegTabAktif = 'program';

    protected $listeners = [
        'proKegGantiTabEvent' => 'proKegGantiTab',
    ];

    public function proKegGantiTab(string $namaTab)
    {
        $this->proKegTabAktif = $namaTab;
    }

    public function render()
    {
        return view('livewire.program-kegiatan-tabs');
    }
}
