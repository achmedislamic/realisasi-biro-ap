<?php

namespace App\Http\Livewire\BidangUrusan;

use App\Models\{BidangUrusan, Urusan};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class BidangUrusanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdUrusanEvent' => 'pilihIdUrusan',
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

        $this->notification()->success(
            'BERHASIL',
            'Data bidang urusan terhapus.'
        );
    }

    public function render()
    {
        $bidangUrusans = BidangUrusan::query()
            ->with('urusan')
            ->where('urusan_id', $this->idUrusan)
            ->pencarian($this->cari)
            ->paginate();

        // dd($bidangUrusans);

        $urusan = Urusan::find($this->idUrusan);

        return view('livewire.bidang-Urusan.bidang-urusan-table', compact(['bidangUrusans', 'urusan']));
    }
}
