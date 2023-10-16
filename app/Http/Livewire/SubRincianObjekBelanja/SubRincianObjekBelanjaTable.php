<?php

namespace App\Http\Livewire\SubRincianObjekBelanja;

use App\Models\{RincianObjekBelanja, SubRincianObjekBelanja};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class SubRincianObjekBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $tahapanApbds;

    public $opdId;

    public $subOpdId;

    public $subKegiatanId;

    public string $menu = '';

    public $idTahapanApbd;

    public int $idRincianObjekBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = ['subKegiatanClicked' => 'getSubRincianObjek'];

    public function
    getSubRincianObjek(int $subKegiatanId, string $menu = '', int|string $opdId = null, int|string $subOpdId = null): void
    {
        $this->subKegiatanId = $subKegiatanId;
        $this->menu = $menu;
        $this->opdId = $opdId;
        $this->subOpdId = $subOpdId;

        $this->emit('gantiTab', 'subRincianObjek');
    }

    public function hapusSubRincianObjekBelanja(int $id): void
    {
        SubRincianObjekBelanja::destroy($id);
        $this->notification()->success(
            'BERHASIL',
            'Data sub rincian objek belanja terhapus.'
        );
    }

    public function render()
    {
        // $subRincianObjekBelanjas = SubRincianObjekBelanja::query()
        //     ->whereRincianObjekBelanjaId($this->idRincianObjekBelanja)
        //     ->pencarian($this->cari)
        //     ->paginate();

        // $rincianObjekBelanja = RincianObjekBelanja::find($this->idRincianObjekBelanja);

        return view(
            'livewire.sub-rincian-objek-belanja.sub-rincian-objek-belanja-table'
            // , compact(['subRincianObjekBelanjas', 'rincianObjekBelanja'])
        );
    }
}
