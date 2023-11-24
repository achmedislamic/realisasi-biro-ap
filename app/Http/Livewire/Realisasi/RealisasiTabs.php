<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Jadwal;
use App\Models\{Opd, SubOpd};
use Illuminate\View\View;
use Livewire\Component;

final class RealisasiTabs extends Component
{
    public string $tabAktif = 'program';

    public $objekRealisasiId;

    public $bidangPilihan;

    public $programId;

    public $kegiatanId;

    public $subKegiatanId;

    public $subRincianObjekId;

    public $subOpdPilihan = '';

    protected $queryString = ['tabAktif', 'programId' => ['except' => ''], 'kegiatanId' => ['except' => ''], 'subRincianObjekId' => ['except' => ''], 'subKegiatanId' => ['except' => ''], 'bidangPilihan' => ['except' => ''], 'subOpdPilihan' => ['except' => '']];

    protected $listeners = ['gantiTab', 'pilihIdProgramEvent', 'pilihIdKegiatanEvent', 'subKegiatanClicked', 'subRincianObjekBelanjaClicked'];

    public function mount(): void
    {
        if (auth()->user()->isBidang()) {
            $this->bidangPilihan = auth()->user()->role->imageable_id;
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdPilihan = auth()->user()->role->imageable_id;
        }
    }

    public function pilihIdProgramEvent($programId): void
    {
        $this->programId = $programId;
        $this->reset(['kegiatanId', 'subKegiatanId', 'objekRealisasiId', 'subRincianObjekId']);
    }

    public function pilihIdKegiatanEvent($kegiatanId): void
    {
        $this->kegiatanId = $kegiatanId;
        $this->reset(['subKegiatanId', 'objekRealisasiId', 'subRincianObjekId']);
    }

    public function subKegiatanClicked($subKegiatanId): void
    {
        $this->subKegiatanId = $subKegiatanId;
        $this->reset(['subRincianObjekId']);
    }

    public function
    subRincianObjekBelanjaClicked(int $subRincianObjekId, int $subKegiatanId, string $menu = '', int|string $opdId = null, int|string $subOpdId = null): void
    {
        $this->subRincianObjekId = $subRincianObjekId;
        $this->subOpdPilihan = $subOpdId;
    }

    public function updatedOpdPilihan($opdId): void
    {
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
