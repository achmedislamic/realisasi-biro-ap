<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Opd;
use App\Models\SubOpd;
use Livewire\Component;

class RealisasiTabs extends Component
{
    public string $tabAktif = 'program';

    public $objekRealisasiId;

    public $opds;

    public $subOpds;

    public $opdPilihan;

    public $subOpdPilihan = '';

    protected $queryString = ['tabAktif', 'opdPilihan' => ['except' => ''], 'subOpdPilihan' => ['except' => '']];

    protected $listeners = [
        'gantiTab' => 'gantiTab',
    ];

    public function mount(): void
    {
        $this->opds = collect();
        $this->subOpds = collect();

        if(auth()->user()->isAdmin()){
            $this->opds = Opd::orderBy('nama')->get();
        }

        if (auth()->user()->isOpd()) {
            $this->opdPilihan = auth()->user()->role->imageable_id;
            $this->subOpds = SubOpd::where('opd_id', $this->opdPilihan)->get();
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdPilihan = auth()->user()->role->imageable_id;
        }
    }

    public function updatedOpdPilihan($opdId)
    {
        $this->subOpds = SubOpd::where('opd_id', $opdId)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;

        $this->emit('opdUpdated', $opdId);
    }

    public function updatedSubOpdPilihan($subOpdId)
    {
        $this->emit('subOpdUpdated', $subOpdId);
    }

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
