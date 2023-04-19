<?php

namespace App\Http\Livewire\SubKegiatan;

use App\Models\{Kegiatan, SubKegiatan};
use App\Traits\Pencarian;
use Illuminate\Database\Eloquent\Builder;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class SubKegiatanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idKegiatan = 0;
    public $menu = '';
    public $opdId = null;
    public $subOpdId = null;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdKegiatanEvent' => 'pilihIdKegiatan',
    ];

    public function pilihIdKegiatan(int $idKegiatan, string $menu = '', int|string $opdId = null, int|string $subOpdId = ''): void
    {
        $this->menu = $menu;
        $this->opdId = $opdId;
        $this->subOpdId = $subOpdId;
        $this->idKegiatan = $idKegiatan;

        $this->emit('gantiTab', 'subKegiatan');
    }

    public function hapusSubKegiatan(int $id): void
    {
        try {
            SubKegiatan::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data sub kegiatan terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data sub kegiatan tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $subKegiatans = SubKegiatan::query()
            ->when(filled($this->menu), function (Builder $query) {
                $query->join('objek_realisasis AS ore', 'ore.sub_kegiatan_id', '=', 'sub_kegiatans.id')
                    ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
                    ->join('sub_opds AS so', 'buso.sub_opd_id', '=', 'so.id')
                    ->join('opds AS o', 'so.opd_id', '=', 'o.id')
                    ->when(filled($this->opdId), function ($query) {
                        $query->where('o.id', $this->opdId);
                    })->when(filled($this->subOpdId), function ($query) {
                        $query->where('so.id', $this->subOpdId);
                    })
                    ->groupBy('sub_kegiatans.id')
                    ->orderBy('sub_kegiatans.kode')
                    ->orderBy('sub_kegiatans.nama');
            })
            ->select('sub_kegiatans.id', 'sub_kegiatans.kode', 'sub_kegiatans.nama')
            ->where('kegiatan_id', $this->idKegiatan)
            ->pencarian($this->cari)
            ->paginate();

        $kegiatan = Kegiatan::find($this->idKegiatan);

        return view('livewire.sub-kegiatan.sub-kegiatan-table', compact('subKegiatans', 'kegiatan'));
    }
}
