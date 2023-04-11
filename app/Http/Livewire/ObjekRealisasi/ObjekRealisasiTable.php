<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\{ObjekRealisasi, Opd, SubOpd, TahapanApbd};
use App\Traits\Pencarian;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class ObjekRealisasiTable extends Component
{
    use WithPagination;
    use Actions;
    use Pencarian;

    public $tahapanApbds;

    public $idTahapanApbd;

    public $pods;

    public $subOpds;

    public $opdPilihan;

    public $subOpdPilihan;

    protected $queryString = ['cari' => ['except' => ''], 'opdPilihan' => ['except' => ''], 'subOpdPilihan' => ['except' => '']];

    public function mount()
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();

        if (auth()->user()->isAdmin()) {
            $this->pods = Opd::orderBy('kode')->get();
        }

        $this->subOpds = collect();

        if (auth()->user()->isOpd()) {
            $this->opdPilihan = auth()->user()->role->imageable_id;
            $this->subOpds = SubOpd::where('opd_id', $this->opdPilihan)->get();
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdPilihan = auth()->user()->role->imageable_id;
        }
    }

    public function updatedOpdPilihan($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;
    }

    public function hapusObjekRealisasiBelanja(int $id): void
    {
        try {
            ObjekRealisasi::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data realisasi belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data realisasi belanja tidak dapat dihapus.'
            );
        }
    }

    public function pilihIdObjekRealisasiEvent(int $idObjekRealisasi)
    {
        $this->emit('pilihIdObjekRealisasiEvent', $idObjekRealisasi);
        $this->emit('gantiTab', 'realisasi', $idObjekRealisasi);
    }

    public function render()
    {
        $realisasiApbds = ObjekRealisasi::query()
            ->with('realisasis')
            ->select('objek_realisasis.id AS id', 'objek_realisasis.sub_kegiatan_id', 'objek_realisasis.anggaran', 'opds.kode AS kode_opd', 'sub_opds.kode AS kode_sub_opd', 'sub_opds.nama AS nama_sub_opd', 'sub_rincian_objek_belanjas.kode AS kode_sub_rincian_objek_belanja', 'sub_rincian_objek_belanjas.nama AS nama_sub_rincian_objek_belanja')
            ->join('sub_rincian_objek_belanjas', 'sub_rincian_objek_belanjas.id', '=', 'objek_realisasis.sub_rincian_objek_belanja_id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'objek_realisasis.bidang_urusan_sub_opd_id')
            ->join('sub_opds', 'sub_opds.id', '=', 'buso.sub_opd_id')
            ->join('opds', 'opds.id', '=', 'sub_opds.opd_id')
            ->where('tahapan_apbd_id', cache('tahapanApbd')->id)
            ->when(filled($this->opdPilihan) && (auth()->user()->isAdmin() || auth()->user()->isOpd()), function (Builder $query) {
                $query->where('opds.id', $this->opdPilihan);
            })
            ->when(filled($this->subOpdPilihan), function (Builder $query) {
                $query->where('sub_opds.id', $this->subOpdPilihan);
            })
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.objek-realisasi.objek-realisasi-table', compact('realisasiApbds'));
    }
}
