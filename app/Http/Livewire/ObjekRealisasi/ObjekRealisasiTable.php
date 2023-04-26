<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\{ObjekRealisasi, Opd, SubKegiatan, SubOpd, TahapanApbd};
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

    public $opdPilihan;

    public $subOpdPilihan;

    public $subKegiatanId;

    public string $menu = '';

    public $idTahapanApbd;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = ['subKegiatanClicked' => 'passData'];

    public function mount(): void
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
    }

    public function passData(int $subKegiatanId, string $menu = '', int|string $opdId = null, int|string $subOpdId = null): void
    {
        $this->subKegiatanId = $subKegiatanId;
        $this->menu = $menu;
        $this->opdPilihan = $opdId;
        $this->subOpdPilihan = $subOpdId;

        $this->emit('gantiTab', 'objekRealisasi');
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
            ->with(['realisasis', 'subKegiatan', 'subRincianObjekBelanja:id,kode,nama,rincian_objek_belanja_id' => [
                'rincianObjekBelanja:id,kode,nama,objek_belanja_id' => [
                    'objekBelanja:id,kode,nama,jenis_belanja_id' => [
                        'jenisBelanja:id,kode,nama,kelompok_belanja_id' => [
                            'kelompokBelanja:id,kode,nama,akun_belanja_id' => [
                                'akunBelanja:id,kode,nama',
                            ],
                        ],
                    ],
                ],
            ]])
            // ->with('realisasis', 'subKegiatan', 'subRincianObjekBelanja.rincianObjekBelanja.objekBelanja.jenisBelanja.kelompokBelanja.akunBelanja')

            // ->join('sub_rincian_objek_belanjas', 'sub_rincian_objek_belanjas.id', '=', 'objek_realisasis.sub_rincian_objek_belanja_id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'objek_realisasis.bidang_urusan_sub_opd_id')
            ->join('sub_opds', 'sub_opds.id', '=', 'buso.sub_opd_id')
            ->join('opds', 'opds.id', '=', 'sub_opds.opd_id')

            ->select('objek_realisasis.id AS id', 'objek_realisasis.sub_kegiatan_id', 'objek_realisasis.anggaran', 'objek_realisasis.sub_rincian_objek_belanja_id')
            ->where('objek_realisasis.sub_kegiatan_id', $this->subKegiatanId)
            ->when(filled($this->opdPilihan) && (auth()->user()->isAdmin() || auth()->user()->isOpd()), function (Builder $query) {
                $query->where('opds.id', $this->opdPilihan);
            })
            ->when(filled($this->subOpdPilihan), function (Builder $query) {
                $query->where('sub_opds.id', $this->subOpdPilihan);
            })
            ->pencarian($this->cari)
            ->paginate();

        $subKegiatan = SubKegiatan::with('kegiatan.program')->find($this->subKegiatanId);
        $subOpd = SubOpd::with('opd')->find($this->subOpdPilihan);

        return view('livewire.objek-realisasi.objek-realisasi-table', compact('realisasiApbds', 'subKegiatan', 'subOpd'));
    }
}
