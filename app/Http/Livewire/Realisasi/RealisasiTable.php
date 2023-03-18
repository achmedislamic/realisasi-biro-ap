<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Realisasi;
use App\Models\TahapanApbd;
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
    public $tanggal;
    public $idTahapanApbd;

    // protected $queryString = [
    //     'cari' => ['except' => ''],
    //     'tanggal' => ['except' => ''],
    //     'idTahapanApbd' => ['except' => '']
    // ];

    public function mount()
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
        $this->tanggal = date('Y-m-d');
    }

    public function hapusRealisasiBelanja(int $id): void
    {
        Realisasi::destroy($id);
    }

    public function render()
    {
        $realisasiApbds = Realisasi::query()
                ->where('tahapan_apbd_id', $this->idTahapanApbd)
                ->where('tanggal', $this->tanggal)
               ->paginate();

        return view('livewire.realisasi.realisasi-table', compact('realisasiApbds'));
    }
}
