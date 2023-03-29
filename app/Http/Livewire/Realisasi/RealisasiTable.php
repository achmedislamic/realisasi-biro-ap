<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\ObjekRealisasi;
use App\Models\Realisasi;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RealisasiTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idObjekRealisasi = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdObjekRealisasiEvent' => 'pilihIdObjekRealisasi'
    ];

    public function pilihIdObjekRealisasi(int $idObjekRealisasi)
    {
        $this->idObjekRealisasi = $idObjekRealisasi;
    }

    public function hapusRealisasi(int $id): void
    {
        try {
            Realisasi::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data realisasi terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data realisasi tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $realisasis = Realisasi::query()
            ->where('objek_realisasi_id', $this->idObjekRealisasi)
            ->orderByDesc('tanggal')
            ->pencarian($this->cari)
            ->paginate();

        $objekRealisasi = ObjekRealisasi::find($this->idObjekRealisasi);

        return view('livewire.realisasi.realisasi-table', compact(['realisasis', 'objekRealisasi']));
    }
}
