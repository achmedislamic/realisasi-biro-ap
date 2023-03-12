<?php

namespace App\Http\Livewire\RincianObjekBelanja;

use App\Models\ObjekBelanja;
use App\Models\RincianObjekBelanja;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RincianObjekBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idObjekBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdObjekBelanjaEvent' => 'pilihIdObjekBelanja'
    ];

    public function pilihIdObjekBelanja(int $idObjekBelanja)
    {
        $this->idObjekBelanja = $idObjekBelanja;
    }

    public function pilihIdRincianObjekBelanjaEvent(int $idRincianObjekBelanja)
    {
        $this->emit('pilihIdRincianObjekBelanjaEvent', $idRincianObjekBelanja);
        $this->emit('rekeningGantiTabEvent', 'sub_rincian_objek');
    }

    public function hapusRincianObjekBelanja(int $id): void
    {
        RincianObjekBelanja::destroy($id);
    }

    public function render()
    {
        $rincianObjekBelanjas = RincianObjekBelanja::query()
                    ->whereObjekBelanjaId($this->idObjekBelanja)
                    ->pencarian($this->cari)
                    ->paginate();

        $objekBelanja = ObjekBelanja::find($this->idObjekBelanja);

        return view('livewire.rincian-objek-belanja.rincian-objek-belanja-table', compact(['rincianObjekBelanjas', 'objekBelanja']));
    }
}
