<?php

namespace App\Http\Livewire\Opd;

use App\Models\BidangUrusan;
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

    public $idBidangUrusan;

    protected $queryString = ['cari' => ['except' => '']];

    public function mount(int $idBidangUrusan): void
    {
        $this->idBidangUrusan = $idBidangUrusan;
    }

    public function hapusOpd(int $id): void
    {
        Opd::destroy($id);
    }

    public function render()
    {
        $opds = Opd::query()
            ->where('bidang_urusan_id', $this->idBidangUrusan)
            ->pencarian($this->cari)
            ->paginate();

        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);

        return view('livewire.opd.opd-table', compact(['opds', 'bidangUrusan']));
    }
}
