<?php

namespace App\Http\Livewire\BidangUrusan;

use App\Models\BidangUrusan;
use App\Models\Urusan;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class BidangUrusanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdUrusanEvent' => 'pilihIdUrusan'
    ];

    public function pilihIdUrusan(int $idUrusan)
    {
        $this->idUrusan = $idUrusan;
    }

    public function pilihIdBidangUrusanEvent(int $idBidangUrusan)
    {
        $this->emit('pilihIdBidangUrusanEvent', $idBidangUrusan);
        $this->emit('gantiTab', 'opd');
    }

    public function hapusBidangUrusan(int $id): void
    {
        BidangUrusan::destroy($id);
    }

    public function render()
    {
        $bidangUrusans = BidangUrusan::query()
            ->whereUrusanId($this->idUrusan)
            ->pencarian($this->cari)
            ->paginate();

        $urusan = Urusan::find($this->idUrusan);

        return view('livewire.bidang-Urusan.bidang-Urusan-table', compact(['bidangUrusans', 'urusan']));
    }
}