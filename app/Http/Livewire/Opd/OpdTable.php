<?php

namespace App\Http\Livewire\Opd;

use App\Models\BidangUrusan;
use App\Models\BidangUrusanOpd;
use App\Models\Opd;
use App\Models\SubOpd;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class OpdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idBidangUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
    'pilihIdBidangUrusanEvent' => 'pilihIdBidangUrusan'
    ];

    public function pilihIdBidangUrusan($idBidangUrusan)
    {
        $this->idBidangUrusan = $idBidangUrusan;
    }

    public function pilihIdOpdEvent(int $idOpd)
    {
        $this->emit('pilihIdOpdEvent', $idOpd, $this->idBidangUrusan);
        $this->emit('gantiTab', 'sub_opd');
    }

    public function hapusOpd(int $id): void
    {
        Opd::destroy($id);
    }

    public function render()
    {
        $opds = Opd::query()
            ->with('bidangUrusans')
            ->whereBidangUrusanId($this->idBidangUrusan)
            ->pencarian($this->cari)
            ->paginate();

        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);

        return view('livewire.opd.opd-table', compact(['opds', 'bidangUrusan']));
    }
}
