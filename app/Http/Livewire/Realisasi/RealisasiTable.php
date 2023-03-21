<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Realisasi;
use App\Models\TahapanApbd;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RealisasiTable extends Component
{
    use WithPagination;
    use Actions;

    public $tahapanApbds;
    public $cari;
    public $dariTanggal;
    public $sampaiTanggal;
    public $idTahapanApbd;

    public function mount()
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
        $this->dariTanggal = date('Y-m-d');
        $this->sampaiTanggal = date('Y-m-d');
    }

    public function hapusRealisasiBelanja(int $id): void
    {
        try {
            Realisasi::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data realisasi belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data realisasi belanja tidak dapat dihapus.'
            );
        }
    }

    public function render()
    {
        $realisasiApbds = Realisasi::query()
            ->where('tahapan_apbd_id', $this->idTahapanApbd)
            ->whereBetween('tanggal', [$this->dariTanggal, $this->sampaiTanggal])
            ->paginate();

        return view('livewire.realisasi.realisasi-table', compact('realisasiApbds'));
    }
}
