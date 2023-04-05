<?php

namespace App\Http\Livewire\RincianObjekBelanja;

use App\Models\{ObjekBelanja, RincianObjekBelanja};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class RincianObjekBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idObjekBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdObjekBelanjaEvent' => 'pilihIdObjekBelanja',
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
        try {
            RincianObjekBelanja::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data rincian objek belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data rincian objek belanja tidak terhapus karena digunakan tabel lain.'
            );
        }
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
