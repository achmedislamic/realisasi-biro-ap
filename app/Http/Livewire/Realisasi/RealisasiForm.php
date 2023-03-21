<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Kegiatan;
use App\Models\Opd;
use App\Models\Program;
use App\Models\Realisasi;
use App\Models\SubKegiatan;
use App\Models\SubOpd;
use App\Models\SubRincianObjekBelanja;
use App\Models\TahapanApbd;
use Livewire\Component;
use WireUi\Traits\Actions;

class RealisasiForm extends Component
{
    use Actions;

    public $tanggal;
    public $idTahapanApbd;
    public $tahapanApbds;
    public $pods;
    public $subOpds;
    public $programs;
    public $kegiatans;
    public $subKegiatans;
    public $subRincianObjekBelanjas;
    public $anggaran;
    public $realisasi;

    public $opdPilihan = null;
    public $subOpdPilihan = null;
    public $programPilihan = null;
    public $kegiatanPilihan = null;
    public $subKegiatanPilihan = null;
    public $rekeningBelanjaPilihan = null;

    public $submitText;
    public $idRealisasi;

    public function mount(int $id = null)
    {
        $this->submitText = "Simpan Realisasi";

        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
        $this->pods = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
        $this->programs = Program::orderBy('kode')->get();
        $this->kegiatans = collect();
        $this->subKegiatans = collect();
        $this->subRincianObjekBelanjas = SubRincianObjekBelanja::orderBy('kode')->get();

        if (!is_null($id)) {
            $this->idRealisasi = $id;
            $this->submitText = "Update Realisasi";

            $realisasiBelanja = Realisasi::find($id);
            $this->idTahapanApbd = $realisasiBelanja->tahapan_apbd_id;
            $this->tanggal = $realisasiBelanja->tanggal;
            $this->anggaran = $realisasiBelanja->anggaran;
            $this->realisasi = $realisasiBelanja->realisasi;
            $this->rekeningBelanjaPilihan = $realisasiBelanja->sub_rincian_objek_id;

            $subOpd = SubOpd::find($realisasiBelanja->sub_opd_id);
            if ($subOpd) {
                $this->subOpds = SubOpd::query()
                    ->where('opd_id', $subOpd->opd_id)
                    ->get();

                $this->subOpdPilihan = $subOpd->id;
                $this->opdPilihan = $subOpd->opd_id;
            }

            $subKegiatan = SubKegiatan::find($realisasiBelanja->sub_kegiatan_id);
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
            'tanggal' => 'required|date',
            'idTahapanApbd' => 'required',
            'opdPilihan' => 'required',
            'subOpdPilihan' => 'required',
            'programPilihan' => 'required',
            'kegiatanPilihan' => 'required',
            'subKegiatanPilihan' => 'required',
            'rekeningBelanjaPilihan' => 'required',
            'anggaran' => 'required',
            'realisasi' => 'required',
        ];
    }

    public function simpan()
    {
        $this->validate();

        if (is_null($this->idRealisasi)) {
            $this->simpanRealisasi();
        } else {
            $this->updateRealisasi($this->idRealisasi);
        }
    }

    public function simpanRealisasi()
    {
        $realisasi = Realisasi::create([
                   'tahapan_apbd_id' => $this->idTahapanApbd,
                   'sub_opd_id' => $this->subOpdPilihan,
                   'sub_kegiatan_id' => $this->subKegiatanPilihan,
                   'sub_rincian_objek_id' => $this->rekeningBelanjaPilihan,
                   'anggaran' => floatval($this->anggaran),
                   'tanggal' => $this->tanggal,
                   'realisasi' => floatval($this->realisasi),
               ]);

        if (!$realisasi) {
            $this->notification()->success(
                'GAGAL !!!',
                'Gagal menyimpan realisasi.'
            );
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Berhasil menyimpan realisasi.'
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
            $this->realisasi = 0;
        }
    }

    public function updateRealisasi(int $id)
    {
        $realisasi = Realisasi::where('id', $id)->update([
            'tahapan_apbd_id' => $this->idTahapanApbd,
            'sub_opd_id' => $this->subOpdPilihan,
            'sub_kegiatan_id' => $this->subKegiatanPilihan,
            'sub_rincian_objek_id' => $this->rekeningBelanjaPilihan,
            'anggaran' => floatval($this->anggaran),
            'tanggal' => $this->tanggal,
            'realisasi' => floatval($this->realisasi),
        ]);

        if (!$realisasi) {
            $this->notification()->success(
                'GAGAL !!!',
                'Gagal update realisas.'
            );
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Berhasil update realisasi.'
            );
        }
    }

    public function flushSession()
    {
        session()->forget('message');
    }

    public function hapusRealisasi(int $id): void
    {
        Realisasi::destroy($id);
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-form');
    }
}
