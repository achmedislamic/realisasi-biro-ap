<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\{ObjekRealisasi, Realisasi, RealisasiFisik};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class RealisasiTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $objekRealisasiId = 0;

    protected $queryString = ['cari' => ['except' => ''], 'objekRealisasiId' => ['except' => 0]];

    protected $listeners = [
        'pilihIdObjekRealisasiEvent' => 'pilihIdObjekRealisasi',
    ];

    public function pilihIdObjekRealisasi(int $objekRealisasiId)
    {
        $this->objekRealisasiId = $objekRealisasiId;
    }

    public function hapusRealisasi(int $id): void
    {
        Realisasi::destroy($id);

        $this->notification()->success(
            'BERHASIL',
            'Data realisasi terhapus.'
        );
    }

    public function hapusRealisasiFisik(int $id): void
    {
        RealisasiFisik::destroy($id);

        $this->notification()->success(
            'BERHASIL',
            'Data realisasi fisik terhapus.'
        );
    }

    public function render()
    {
        $realisasis = Realisasi::query()
            ->where('objek_realisasi_id', $this->objekRealisasiId)
            ->orderByDesc('tanggal')
            ->pencarian($this->cari)
            ->paginate();

        $realisasiFisiks = RealisasiFisik::query()
            ->where('objek_realisasi_id', $this->objekRealisasiId)
            ->orderByDesc('tanggal')
            ->pencarian($this->cari)
            ->get();

        $objekRealisasi = ObjekRealisasi::with(['bidangUrusanSubOpd.subOpd', 'realisasiFisiks'])->find($this->objekRealisasiId);

        return view('livewire.realisasi.realisasi-table', compact(['realisasis', 'objekRealisasi', 'realisasiFisiks']));
    }
}
