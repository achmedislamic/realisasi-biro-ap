<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UrusanOpdTabs extends Component
{
    public string $tabAktif = 'urusan';

    protected $listeners = ['gantiTab'];

    public function mount()
    {
        if(request()->segment(3) == 'opd'){
            $this->tabAktif = 'opd';
        }
    }

    public function gantiTab(string $namaTab)
    {
        $this->tabAktif = $namaTab;
    }

    public function render()
    {
        return view('livewire.urusan-opd-tabs');
    }
}
