<?php

namespace App\Http\Livewire\SubKegiatan;

use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubKegiatanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idKegiatan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdKegiatanEvent' => 'pilihIdKegiatan'
    ];

    public function pilihIdKegiatan(int $idKegiatan): void
    {
        $this->idKegiatan = $idKegiatan;
    }

    public function hapusSubKegiatan(int $id): void
    {
        SubKegiatan::destroy($id);
    }

    public function render()
    {
        $subKegiatans = SubKegiatan::query()
        ->whereKegiatanId($this->idKegiatan)
        ->pencarian($this->cari)
        ->paginate();

        $kegiatan = Kegiatan::find($this->idKegiatan);

        return view('livewire.sub-kegiatan.sub-kegiatan-table', compact(['subKegiatans', 'kegiatan']));
    }
}
