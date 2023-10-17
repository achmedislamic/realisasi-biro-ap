<?php

namespace App\Http\Livewire\SubRincianObjekBelanja;

use App\Models\{ObjekRealisasi, RincianObjekBelanja, SubKegiatan, SubRincianObjekBelanja};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
        $subRincianObjeks = SubRincianObjekBelanja::query()
            ->join('rincian_belanjas AS rb', 'rb.sub_rincian_objek_belanja_id', '=', 'sub_rincian_objek_belanjas.id')
            ->join('objek_realisasis AS ore', 'ore.rincian_belanja_id', '=', 'rb.id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
            ->join('sub_opds', 'sub_opds.id', '=', 'buso.sub_opd_id')
            ->join('opds', 'opds.id', '=', 'sub_opds.opd_id')
            ->select(
                'sub_rincian_objek_belanjas.id',
                'sub_rincian_objek_belanjas.kode',
                'sub_rincian_objek_belanjas.nama',
                'ore.bidang_urusan_sub_opd_id',
                'opds.kode as kode_opd',
                'opds.nama as nama_opd',
                'sub_opds.kode as kode_sub_opd',
                'sub_opds.nama as nama_sub_opd'
            )
            ->where('ore.sub_kegiatan_id', $this->subKegiatanId)
            ->when(filled($this->opdId) && (auth()->user()->isAdmin()), function (Builder $query) {
                $query->where('opds.id', $this->opdId);
            })
            ->when(filled($this->subOpdId), function (Builder $query) {
                $query->where('sub_opds.id', $this->subOpdId);
            })
            ->pencarian($this->cari)
            ->paginate();

        $subKegiatan = SubKegiatan::with('kegiatan.program')->find($this->subKegiatanId);

        return view(
            'livewire.sub-rincian-objek-belanja.sub-rincian-objek-belanja-table',
            compact('subRincianObjeks', 'subKegiatan')
        );
    }
}
