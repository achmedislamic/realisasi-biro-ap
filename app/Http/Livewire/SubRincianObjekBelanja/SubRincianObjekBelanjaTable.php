<?php

namespace App\Http\Livewire\SubRincianObjekBelanja;

use App\Models\RincianObjekBelanja;
use App\Models\SubRincianObjekBelanja;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubRincianObjekBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idRincianObjekBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdRincianObjekBelanjaEvent' => 'pilihIdRincianObjekBelanja'
    ];

    public function pilihIdRincianObjekBelanja(int $idRincianObjekBelanja)
    {
        $this->idRincianObjekBelanja = $idRincianObjekBelanja;
    }

    public function hapusSubRincianObjekBelanja(int $id): void
    {
        SubRincianObjekBelanja::destroy($id);
    }

    public function render()
    {
        $subRincianObjekBelanjas = SubRincianObjekBelanja::query()
                           ->whereRincianObjekBelanjaId($this->idRincianObjekBelanja)
                           ->pencarian($this->cari)
                           ->paginate();

        $rincianObjekBelanja = RincianObjekBelanja::find($this->idRincianObjekBelanja);

        return view('livewire.sub-rincian-objek-belanja.sub-rincian-objek-belanja-table', compact(['subRincianObjekBelanjas', 'rincianObjekBelanja']));
    }
}
