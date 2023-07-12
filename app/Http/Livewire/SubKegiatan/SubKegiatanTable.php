<?php

namespace App\Http\Livewire\SubKegiatan;

use App\Models\{Kegiatan, SubKegiatan};
use App\Traits\Pencarian;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class SubKegiatanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $kegiatanId = 0;

    public $menu = '';

    public $opdId = null;

    public $subOpdId = null;

    protected $listeners = [
        'pilihIdKegiatanEvent' => 'pilihIdKegiatan',
    ];

    public function pilihIdKegiatan(int $kegiatanId, string $menu = '', int|string $opdId = null, int|string $subOpdId = ''): void
    {
        $this->menu = $menu;
        $this->opdId = $opdId;
        $this->subOpdId = $subOpdId;
        $this->kegiatanId = $kegiatanId;

        $this->emit('gantiTab', 'subKegiatan');
    }

    public function hapusSubKegiatan(int $id): void
    {
        SubKegiatan::destroy($id);
        $this->notification()->success(
            'BERHASIL',
            'Data sub kegiatan terhapus.'
        );
    }

    public function render()
    {
        // dd($this->menu);
        Gate::authorize('realisasi-menu', [$this->opdId, $this->subOpdId]);

        $subKegiatans = SubKegiatan::query()
            ->when(filled($this->menu), function (Builder $query) {
                $query->join('objek_realisasis AS ore', 'ore.sub_kegiatan_id', '=', 'sub_kegiatans.id')
                    ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
                    ->join('sub_opds AS so', 'buso.sub_opd_id', '=', 'so.id')
                    ->join('opds AS o', 'so.opd_id', '=', 'o.id')
                    ->when(filled($this->opdId), function ($query) {
                        $query->where('o.id', $this->opdId);
                    })
                    ->when(filled($this->subOpdId), function ($query) {
                        $query->where('so.id', $this->subOpdId);
                    })
                    ->select('sub_kegiatans.id', 'sub_kegiatans.kode', 'sub_kegiatans.nama', 'o.kode AS kode_opd', 'o.nama AS nama_opd', 'so.kode AS kode_sub_opd', 'so.nama AS nama_sub_opd', 'o.id AS opd_id', 'so.id AS sub_opd_id')
                    ->groupByRaw('so.id, sub_kegiatans.id')
                    ->orderBy('sub_kegiatans.kode')
                    ->orderBy('sub_kegiatans.nama');
            })
            ->when(blank($this->menu), function (Builder $query) {
                $query->select('sub_kegiatans.id', 'sub_kegiatans.kode', 'sub_kegiatans.nama');
            })
            ->where('kegiatan_id', $this->kegiatanId)
            ->pencarian($this->cari)
            // ->ddRawSql()
            ->paginate();

        $kegiatan = Kegiatan::find($this->kegiatanId);

        return view('livewire.sub-kegiatan.sub-kegiatan-table', compact('subKegiatans', 'kegiatan'));
    }
}
