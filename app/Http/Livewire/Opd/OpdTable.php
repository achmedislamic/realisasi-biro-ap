<?php

namespace App\Http\Livewire\Opd;

use App\Models\BidangUrusanOpd;
use App\Models\{BidangUrusan, Opd};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class OpdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idBidangUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdBidangUrusanEvent' => 'pilihIdBidangUrusan',
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
        try {
            Opd::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data OPD terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data OPD tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $bidangUrusans = BidangUrusanOpd::query()
            ->where('bidang_urusan_opds.id', $this->idBidangUrusan)
            ->pencarian($this->cari)
            ->paginate();

        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);

        return view('livewire.opd.opd-table', compact('bidangUrusans', 'bidangUrusan'));
    }
}
