<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\{Opd, SubOpd};
use App\Traits\Pencarian;
use Illuminate\Database\Eloquent\Builder;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class SubOpdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idOpd = 0;

    public $idBidangUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdOpdEvent' => 'pilihIdOpd',
    ];

    public function pilihIdOpd($idOpd, $idBidangUrusan)
    {
        $this->idOpd = $idOpd;
        $this->idBidangUrusan = $idBidangUrusan;
    }

    public function hapusSubOpd(int $id): void
    {
        try {
            SubOpd::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data sub OPD terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data sub OPD tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $subOpds = SubOpd::query()
            ->where('opd_id', $this->idOpd)
            ->whereRelation('bidangUrusans', 'bidang_urusans.id', $this->idBidangUrusan)
            ->pencarian($this->cari)
            ->paginate();

        $opd = Opd::query()
            ->with('subOpds.bidangUrusans')
            ->where('id', $this->idOpd)
            ->first();

        return view('livewire.sub-opd.sub-opd-table', compact('subOpds', 'opd'));
    }
}
