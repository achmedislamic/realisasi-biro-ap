<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Jadwal;
use App\Models\{Opd, SubOpd};
use Illuminate\View\View;
use Livewire\Component;

class RealisasiTabs extends Component
{
    public string $tabAktif = 'program';

    public $objekRealisasiId;

    public $opds;

    public $subOpds;

    public $opdPilihan;

    public $programId;

    public $kegiatanId;

    public $subKegiatanId;

    public $subOpdPilihan = '';

    protected $queryString = ['tabAktif', 'programId' => ['except' => ''], 'kegiatanId' => ['except' => ''], 'subKegiatanId' => ['except' => ''], 'opdPilihan' => ['except' => ''], 'subOpdPilihan' => ['except' => '']];

    protected $listeners = ['gantiTab', 'pilihIdProgramEvent', 'pilihIdKegiatanEvent', 'subKegiatanClicked'];

    public function mount(): void
    {
        $this->opds = collect();
        $this->subOpds = collect();

        if (auth()->user()->isAdmin()) {
            $this->opds = Opd::orderBy('nama')->get();
        }

        if (auth()->user()->isOpd()) {
            $this->opdPilihan = auth()->user()->role->imageable_id;

        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdPilihan = auth()->user()->role->imageable_id;
        }

        if (filled($this->opdPilihan) && (auth()->user()->isAdmin() || auth()->user()->isOpd())) {
            $this->subOpds = SubOpd::where('opd_id', $this->opdPilihan)->get();
        }
    }

    public function pilihIdProgramEvent($programId): void
    {
        $this->programId = $programId;
    }

    public function pilihIdKegiatanEvent($kegiatanId): void
    {
        $this->kegiatanId = $kegiatanId;
    }

    public function subKegiatanClicked($subKegiatanId): void
    {
        $this->subKegiatanId = $subKegiatanId;
    }

    public function updatedOpdPilihan($opdId): void
    {
        $this->subOpds = SubOpd::where('opd_id', $opdId)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;

        $this->emit('opdUpdated', $opdId);
        $this->emit('gantiTab', 'program');
    }

    public function updatedSubOpdPilihan($subOpdId): void
    {
        $this->emit('subOpdUpdated', $subOpdId);
        $this->emit('gantiTab', 'program');
    }

    public function gantiTab(string $namaTab, $objekRealisasiId = null): void
    {
        $this->tabAktif = $namaTab;
        $this->objekRealisasiId = $objekRealisasiId;
    }

    public function render(): View
    {
        return view('livewire.realisasi.realisasi-tabs', [
            'jadwal' => Jadwal::where('is_aktif', true)->first(),
        ]);
    }
}
