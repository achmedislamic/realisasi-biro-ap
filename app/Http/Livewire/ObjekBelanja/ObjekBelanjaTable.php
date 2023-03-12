<?php

namespace App\Http\Livewire\ObjekBelanja;

use App\Models\JenisBelanja;
use App\Models\ObjekBelanja;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ObjekBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idJenisBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdJenisBelanjaEvent' => 'pilihIdJenisBelanja'
    ];

    public function pilihIdJenisBelanja(int $idJenisBelanja)
    {
        $this->idJenisBelanja = $idJenisBelanja;
    }

    public function pilihIdObjekBelanjaEvent(int $idObjekBelanja)
    {
        $this->emit('pilihIdObjekBelanjaEvent', $idObjekBelanja);
        $this->emit('rekeningGantiTabEvent', 'rincian_objek');
    }

    public function hapusObjekBelanja(int $id): void
    {
        ObjekBelanja::destroy($id);
    }

    public function render()
    {
        $objekBelanjas = ObjekBelanja::query()
                    ->whereJenisBelanjaId($this->idJenisBelanja)
                    ->pencarian($this->cari)
                    ->paginate();

        $jenisBelanja = JenisBelanja::find($this->idJenisBelanja);

        return view('livewire.objek-belanja.objek-belanja-table', compact(['objekBelanjas', 'jenisBelanja']));
    }
}
