<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\{BidangUrusan, RincianBelanja, Urusan};
use App\Models\{BidangUrusanSubOpd, Kegiatan, ObjekRealisasi, Opd, Program, Realisasi, SubKegiatan, SubOpd};
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class ObjekRealisasiForm extends Component
{
    use Actions;

    public $subOpds;

    public $programs;

    public $kegiatans;

    public $subKegiatans;

    public $urusans;

    public $bidangUrusans;

    public $rincianBelanjas;

    public $anggaran;

    public $satuanId;

    public $sumberDanaId;

    public $kategoriId;

    public $anggotaDprdId;

    public $target;

    public $urusanPilihan = null;

    public $bidangUrusanPilihan = null;

    public $opdPilihan = null;

    public $subOpdPilihan = null;

    public $programPilihan = null;

    public $kegiatanPilihan = null;

    public $subKegiatanPilihan = null;

    public $subRincianObjekId = null;

    public $subKegiatan = null;

    public $rekeningBelanjaPilihan = null;

    public $rincianBelanjaPilihan = null;

    public $submitText;

    public $idObjekRealisasi;

    protected $queryString = ['opdPilihan' => ['except' => ''], 'subOpdPilihan' => ['except' => ''], 'programPilihan' => ['except' => ''], 'kegiatanPilihan' => ['except' => ''], 'subKegiatanPilihan' => ['except' => ''], 'subRincianObjekId' => ['except' => '']];

    public function mount(int $id = null)
    {
        $this->subOpds = collect();
        if (filled($this->opdPilihan) && filled($this->subOpdPilihan)) {
            $this->subOpds = SubOpd::where('opd_id', $this->opdPilihan)->get();
        }

        $this->programs = Program::orderBy('kode')->orderBy('nama')->get();
        $this->kegiatans = collect();
        $this->subKegiatans = collect();
        if (filled($this->programPilihan) && filled($this->kegiatanPilihan)) {
            $this->kegiatans = Kegiatan::query()
                ->where('program_id', $this->programPilihan)
                ->orderBy('kode')
                ->orderBy('nama')
                ->get();

            if (filled($this->subKegiatanPilihan)) {
                $this->subKegiatans = SubKegiatan::query()
                    ->where('kegiatan_id', $this->kegiatanPilihan)
                    ->orderBy('kode')
                    ->orderBy('nama')
                    ->get();
            }
        }

        $this->rincianBelanjas = collect();

        $this->submitText = 'Simpan';
        $this->urusans = Urusan::orderBy('kode')->get();

        if (is_null($id)) {
            $this->bidangUrusans = BidangUrusan::orderBy('kode')->get();
            $this->rincianBelanjas = RincianBelanja::where('sub_rincian_objek_belanja_id', $this->subRincianObjekId)->orderBy('kode')->get();
            $this->rekeningBelanjaPilihan = $this->subRincianObjekId;
        }

        if (!is_null($id)) {
            $this->idObjekRealisasi = $id;
            $this->submitText = 'Ubah';

            $this->urusans = Urusan::orderBy('kode')->get();

            $objekRealisasi = ObjekRealisasi::with('bidangUrusanSubOpd.bidangUrusan')->find($id);
            $this->urusanPilihan = $objekRealisasi->bidangUrusanSubOpd->bidangUrusan->urusan_id;
            $this->bidangUrusans = BidangUrusan::where('urusan_id', $this->urusanPilihan)->orderBy('kode')->get();
            $this->bidangUrusanPilihan = $objekRealisasi->bidangUrusanSubOpd->bidang_urusan_id;

            $this->anggaran = $objekRealisasi->anggaran;
            $subRincianObjekBelanjaId = $objekRealisasi->rincianBelanja->sub_rincian_objek_belanja_id;
            $this->rekeningBelanjaPilihan = $subRincianObjekBelanjaId;
            $this->rincianBelanjas = RincianBelanja::where('sub_rincian_objek_belanja_id', $subRincianObjekBelanjaId)->orderBy('kode')->get();
            $this->rincianBelanjaPilihan = $objekRealisasi->rincian_belanja_id;

            $this->target = $objekRealisasi->target;
            $this->satuanId = $objekRealisasi->satuan_id;
            $this->sumberDanaId = $objekRealisasi->sumber_dana_id;
            $this->kategoriId = $objekRealisasi->kategori_id;
            $this->anggotaDprdId = $objekRealisasi->anggota_dprd_id;

            $subOpd = SubOpd::find($objekRealisasi->bidangUrusanSubOpd->sub_opd_id);
            if ($subOpd) {
                $this->subOpds = SubOpd::query()
                    ->where('opd_id', $subOpd->opd_id)
                    ->get();

                $this->subOpdPilihan = $subOpd->id;
                $this->opdPilihan = $subOpd->opd_id;
            }

            $subKegiatan = SubKegiatan::with('kegiatan.program')->find($objekRealisasi->sub_kegiatan_id);
            if ($subKegiatan) {
                $this->programPilihan = $subKegiatan->kegiatan->program->id;

                $this->kegiatans = Kegiatan::query()
                    ->where('program_id', $subKegiatan->kegiatan->program->id)
                    ->get();

                $this->subKegiatans = SubKegiatan::query()
                    ->where('kegiatan_id', $subKegiatan->kegiatan->id)
                    ->get();

                $this->kegiatanPilihan = $subKegiatan->kegiatan->id;
                $this->subKegiatanPilihan = $subKegiatan->id;
                $this->subKegiatan = $subKegiatan;
            }
        }
    }

    public function updatedUrusanPilihan($value)
    {
        $this->bidangUrusans = BidangUrusan::where('urusan_id', $value)->orderBy('kode')->get();
        $this->reset('bidangUrusanPilihan');
    }

    public function updatedOpdPilihan($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;
    }

    public function updatedProgramPilihan($program)
    {
        $this->kegiatans = Kegiatan::where('program_id', $program)
            ->orderBy('kode')
            ->get();
        $this->kegiatanPilihan = null;
    }

    public function updatedKegiatanPilihan($kegiatan)
    {
        $this->subKegiatans = SubKegiatan::where('kegiatan_id', $kegiatan)
            ->orderBy('kode')
            ->get();
        $this->subKegiatanPilihan = null;
    }

    public function updatedRekeningBelanjaPilihan($rekening)
    {
        $this->rincianBelanjas = RincianBelanja::where('sub_rincian_objek_belanja_id', $rekening)
            ->orderBy('kode')
            ->get();
        $this->rincianBelanjaPilihan = null;
    }

    protected function rules(): array
    {
        return [
            'bidangUrusanPilihan' => 'required|numeric',
            'opdPilihan' => 'required|numeric',
            'subOpdPilihan' => 'required|numeric',
            'programPilihan' => 'required|numeric',
            'kegiatanPilihan' => 'required|numeric',
            'subKegiatanPilihan' => 'required|numeric',
            'rekeningBelanjaPilihan' => 'required|numeric',
            'rincianBelanjaPilihan' => 'required|numeric',
            'anggaran' => 'required',
            'target' => 'required',
            'satuanId' => 'required|numeric',
            'sumberDanaId' => 'nullable|numeric',
            'kategoriId' => 'nullable|numeric',
            'anggotaDprdId' => 'nullable|numeric',
        ];
    }

    public function simpan()
    {
        $this->validate();

        if (is_null($this->idObjekRealisasi)) {
            $this->simpanObjekRealisasi();
        } else {
            $sumRealisasi = Realisasi::query()
                ->where('objek_realisasi_id', $this->idObjekRealisasi)
                ->sum('jumlah');

            if ($sumRealisasi > floatval($this->anggaran)) {
                $this->notification()->error(
                    'GAGAL !!!',
                    'Gagal menyimpan objek realisasi. Total realisasi lebih besar dari nilai anggaran yang dimasukan.'
                );
            } else {
                $this->updateObjekRealisasi($this->idObjekRealisasi);
            }
        }
    }

    public function simpanObjekRealisasi()
    {
        $realisasi = ObjekRealisasi::create([
            'tahapan_apbd_id' => cache('tahapanApbd')->id,
            'bidang_urusan_sub_opd_id' => BidangUrusanSubOpd::where('bidang_urusan_id', $this->bidangUrusanPilihan)->where('sub_opd_id', $this->subOpdPilihan)->first()->id,
            'sub_kegiatan_id' => $this->subKegiatanPilihan,
            'rincian_belanja_id' => $this->rincianBelanjaPilihan,
            'anggaran' => floatval($this->anggaran),
            'target' => $this->target,
            'satuan_id' => $this->satuanId,
            'sumber_dana_id' => $this->sumberDanaId,
            'kategori_id' => $this->kategoriId,
            'anggota_dprd_id' => $this->anggotaDprdId,
        ]);

        if (!$realisasi) {
            $this->notification()->error(
                'GAGAL !!!',
                'Gagal menyimpan objek realisasi.'
            );
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Berhasil menyimpan objek realisasi.'
            );
            $this->opdPilihan = null;
            $this->subOpdPilihan = null;
            $this->programPilihan = null;
            $this->kegiatanPilihan = null;
            $this->subKegiatanPilihan = null;
            $this->rekeningBelanjaPilihan = null;
            $this->rincianBelanjaPilihan = null;

            $this->subOpds = collect();
            $this->kegiatans = collect();
            $this->subKegiatans = collect();
            $this->anggaran = 0;
        }

        return redirect()->back();
    }

    public function updateObjekRealisasi(int $id)
    {
        $update = [
            'target' => $this->target,
            'satuan_id' => $this->satuanId,
            'sumber_dana_id' => $this->sumberDanaId,
            'kategori_id' => $this->kategoriId,
            'anggota_dprd_id' => $this->anggotaDprdId,
        ];

        if (auth()->user()->isAdmin()) {
            $update = [
                'sub_kegiatan_id' => $this->subKegiatanPilihan,
                'rincian_belanja_id' => $this->rincianBelanjaPilihan,
                'anggaran' => floatval($this->anggaran),
                ...$update,
            ];
        }

        ObjekRealisasi::where('id', $id)->update($update);

        $this->notification()->success(
            'BERHASIL',
            'Berhasil mengubah data Rekening Belanja.'
        );

        $objekRealisasi = ObjekRealisasi::with('bidangUrusanSubOpd.subOpd')->find($id);

        return to_route('realisasi', [
            'tabAktif' => 'objekRealisasi',
            'programId' => $this->subKegiatan->kegiatan->program_id,
            'kegiatanId' => $this->subKegiatan->kegiatan->id,
            'subKegiatanId' => $this->subKegiatan->id,
            'opdPilihan' => $objekRealisasi->bidangUrusanSubOpd->subOpd->opd_id,
            'subOpdPilihan' => $objekRealisasi->bidangUrusanSubOpd->subOpd->id,
            'subRincianObjekId' => $objekRealisasi->rincianBelanja->sub_rincian_objek_belanja_id
        ]);
    }

    public function hapusObjekRealisasi(int $id): void
    {
        ObjekRealisasi::destroy($id);
    }

    public function render(): View
    {
        return view('livewire.objek-realisasi.objek-realisasi-form');
    }
}
