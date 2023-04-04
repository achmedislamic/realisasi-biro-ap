<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\Kegiatan;
use App\Models\ObjekRealisasi;
use App\Models\Opd;
use App\Models\Program;
use App\Models\Realisasi;
use App\Models\SubKegiatan;
use App\Models\SubOpd;
use App\Models\SubRincianObjekBelanja;
use Livewire\Component;
use WireUi\Traits\Actions;

class ObjekRealisasiForm extends Component
{
    use Actions;

    public $pods;

    public $subOpds;

    public $programs;

    public $kegiatans;

    public $subKegiatans;

    public $subRincianObjekBelanjas;

    public $anggaran;

    public $opdPilihan = null;

    public $subOpdPilihan = null;

    public $programPilihan = null;

    public $kegiatanPilihan = null;

    public $subKegiatanPilihan = null;

    public $rekeningBelanjaPilihan = null;

    public $submitText;

    public $idObjekRealisasi;

    public function mount(int $id = null)
    {
        $this->submitText = 'Simpan Objek Realisasi';

        $this->pods = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
        $this->programs = Program::orderBy('kode')->get();
        $this->kegiatans = collect();
        $this->subKegiatans = collect();
        $this->subRincianObjekBelanjas = SubRincianObjekBelanja::orderBy('kode')->get();

        if (! is_null($id)) {
            $this->idObjekRealisasi = $id;
            $this->submitText = 'Update Realisasi';

            $objekRealisasi = ObjekRealisasi::find($id);
            $this->anggaran = $objekRealisasi->anggaran;
            $this->rekeningBelanjaPilihan = $objekRealisasi->sub_rincian_objek_id;

            $subOpd = SubOpd::find($objekRealisasi->sub_opd_id);
            if ($subOpd) {
                $this->subOpds = SubOpd::query()
                    ->where('opd_id', $subOpd->opd_id)
                    ->get();

                $this->subOpdPilihan = $subOpd->id;
                $this->opdPilihan = $subOpd->opd_id;
            }

            $subKegiatan = SubKegiatan::find($objekRealisasi->sub_kegiatan_id);
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
            }
        }
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

    protected function rules(): array
    {
        return [
            'opdPilihan' => 'required',
            'subOpdPilihan' => 'required',
            'programPilihan' => 'required',
            'kegiatanPilihan' => 'required',
            'subKegiatanPilihan' => 'required',
            'rekeningBelanjaPilihan' => 'required',
            'anggaran' => 'required',
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
                ->sum('realisasi');

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
            'sub_opd_id' => $this->subOpdPilihan,
            'sub_kegiatan_id' => $this->subKegiatanPilihan,
            'sub_rincian_objek_id' => $this->rekeningBelanjaPilihan,
            'anggaran' => floatval($this->anggaran),
        ]);

        if (! $realisasi) {
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

            $this->subOpds = collect();
            $this->kegiatans = collect();
            $this->subKegiatans = collect();
            $this->anggaran = 0;
        }
    }

    public function updateObjekRealisasi(int $id)
    {
        $realisasi = ObjekRealisasi::where('id', $id)->update([
            'tahapan_apbd_id' => cache('tahapanApbd')->id,
            'sub_opd_id' => $this->subOpdPilihan,
            'sub_kegiatan_id' => $this->subKegiatanPilihan,
            'sub_rincian_objek_id' => $this->rekeningBelanjaPilihan,
            'anggaran' => floatval($this->anggaran),
        ]);

        if (! $realisasi) {
            $this->notification()->error(
                'GAGAL !!!',
                'Gagal update objek realisasi.'
            );
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Berhasil update objek realisasi.'
            );
        }
    }

    public function flushSession()
    {
        session()->forget('message');
    }

    public function hapusObjekRealisasi(int $id): void
    {
        ObjekRealisasi::destroy($id);
    }

    public function render()
    {
        return view('livewire.objek-realisasi.objek-realisasi-form');
    }
}
