<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RekeningBelanjaTabs extends Component
{
    public string $rekeningTabAktif = 'akun';

    protected $listeners = [
        'rekeningGantiTabEvent' => 'rekeningKegGantiTab'
    ];

    public function rekeningKegGantiTab(string $namaTab)
    {
        $this->rekeningTabAktif = $namaTab;
    }

    public function render()
    {
        return view('livewire.rekening-belanja-tabs');
    }
}
