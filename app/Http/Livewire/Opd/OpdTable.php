<?php

namespace App\Http\Livewire\Opd;

use App\Models\{BidangUrusan, Opd};
use App\Traits\Pencarian;
use Illuminate\Database\Eloquent\Builder;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class OpdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idBidangUrusan = 0;

    public $mode;

    protected $queryString = ['cari' => ['except' => ''], 'mode'];

    protected $listeners = [
        'pilihIdBidangUrusanEvent' => 'pilihIdBidangUrusan',
    ];

    public function mount()
    {
        $this->mode = request()->segment(3);
    }

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
        if($this->mode == 'informasi'){
            $opds = Opd::orderBy('nama')->paginate();
        } else {
            // daftar opd yang memiliki bidang urusan terpilih
            $opds = Opd::query()
            ->whereHas('subOpds.bidangUrusans', function (Builder $query) {
                $query->where('bidang_urusans.id', $this->idBidangUrusan);
            })
            ->pencarian($this->cari)
            ->paginate();
        }

        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);

        return view('livewire.opd.opd-table', compact('opds', 'bidangUrusan'));
    }
}
