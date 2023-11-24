<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\{ObjekRealisasi, RincianBelanja, SubKegiatan, SubOpd, SubRincianObjekBelanja, TahapanApbd};
use App\Traits\Pencarian;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

final class ObjekRealisasiTable extends Component
{
    use Actions, Pencarian, WithPagination;

    public $tahapanApbds;

    public $opdId;

    public $subOpdPilihan;

    public $subKegiatanId;

    public $subRincianObjekId;

    public string $menu = '';

    public $idTahapanApbd;

    protected $queryString = ['cari' => ['except' => ''], 'subRincianObjekId' => ['except' => ''], 'subOpdPilihan' => ['except' => '']];

    protected $listeners = ['subRincianObjekBelanjaClicked' => 'getObjekRealisasi'];

    public function mount(): void
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
    }

    public function getObjekRealisasi(int $subRincianObjekId, int $subKegiatanId, string $menu = '', int|string $opdId = null, int|string $subOpdId = null): void
    {
        $this->subKegiatanId = $subKegiatanId;
        $this->subRincianObjekId = $subRincianObjekId;
        $this->menu = $menu;
        $this->opdId = $opdId;
        $this->subOpdPilihan = $subOpdId;

        $this->emit('gantiTab', 'objekRealisasi');
    }

    public function hapusObjekRealisasiBelanja(int $id): void
    {
        ObjekRealisasi::destroy($id);
        $this->notification()->success(
            'BERHASIL',
            'Data realisasi belanja terhapus.'
        );
    }

    public function pilihIdObjekRealisasiEvent(int $idObjekRealisasi)
    {
        $this->emit('pilihIdObjekRealisasiEvent', $idObjekRealisasi);
        $this->emit('gantiTab', 'realisasi', $idObjekRealisasi);
    }

    public function render()
    {
        $realisasiApbds = ObjekRealisasi::query()
            ->with(['realisasis', 'rincianBelanja'])
            ->join('rincian_belanjas as rb', 'rb.id', '=', 'objek_realisasis.rincian_belanja_id')
            ->join('sub_rincian_objek_belanjas as srob', 'srob.id', '=', 'rb.sub_rincian_objek_belanja_id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'objek_realisasis.bidang_urusan_sub_opd_id')
            ->join('sub_opds', 'sub_opds.id', '=', 'buso.sub_opd_id')
            ->join('opds', 'opds.id', '=', 'sub_opds.opd_id')
            ->leftJoin('satuans AS s', 's.id', '=', 'objek_realisasis.satuan_id')
            ->leftJoin('sumber_danas AS sd', 'sd.id', '=', 'objek_realisasis.sumber_dana_id')
            ->leftJoin('kategoris AS k', 'k.id', '=', 'objek_realisasis.kategori_id')

            ->select(
                'objek_realisasis.id AS id',
                'objek_realisasis.sub_kegiatan_id',
                'objek_realisasis.anggaran',
                'objek_realisasis.rincian_belanja_id',
                'objek_realisasis.target',
                'rb.kode as rb_kode',
                'rb.nama as rb_nama',
                's.nama as nama_satuan',
                'sd.id as sumber_dana_id',
                'sd.nama as nama_sumber_dana',
                'k.id as kategori_id',
                'k.nama as nama_kategori',
            )
            ->where('objek_realisasis.sub_kegiatan_id', $this->subKegiatanId)
            ->where('srob.id', $this->subRincianObjekId)
            ->where('buso.sub_opd_id', $this->subOpdPilihan)
            ->pencarian($this->cari)
            ->paginate();

        $subKegiatan = SubKegiatan::with('kegiatan.program')->find($this->subKegiatanId);
        $subOpd = SubOpd::with('opd')->find($this->subOpdPilihan);

        $subRincianObjek = SubRincianObjekBelanja::find($this->subRincianObjekId);

        return view('livewire.objek-realisasi.objek-realisasi-table', compact('realisasiApbds', 'subKegiatan', 'subOpd', 'subRincianObjek'));
    }
}
