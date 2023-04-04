<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\ObjekRealisasi;
use App\Models\Realisasi;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class RealisasiForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public $tanggal;

    public $realisasi;

    public $idObjekRealisasi;

    public $idRealisasi;

    public $submitText;

    public ObjekRealisasi $objekRealisasi;

    public $pod;

    public $subOpd;

    public $program;

    public $kegiatan;

    public $subKegiatan;

    public $subRincianObjekBelanja;

    public $anggaran;

    public function mount(int $idObjekRealisasi, int $id = null)
    {
        $this->submitText = 'Simpan Realisasi';
        $this->idObjekRealisasi = $idObjekRealisasi;
        $this->objekRealisasi = ObjekRealisasi::find($idObjekRealisasi);

        $this->pod = $this->objekRealisasi->subOpd->opd->nama;
        $this->subOpd = $this->objekRealisasi->subOpd->nama;
        $this->program = $this->objekRealisasi->subKegiatan->kegiatan->program->nama;
        $this->kegiatan = $this->objekRealisasi->subKegiatan->kegiatan->nama;
        $this->subKegiatan = $this->objekRealisasi->subKegiatan->nama;
        $this->subRincianObjekBelanja = $this->objekRealisasi->subRincianObjekBelanja->nama;
        $this->anggaran = number_format($this->objekRealisasi->anggaran, 2, ',', '.');

        if (! is_null($id)) {
            $this->idRealisasi = $id;
            $this->submitText = 'Update Realisasi';

            $realisasiBelanja = Realisasi::find($id);
            $this->tanggal = $realisasiBelanja->tanggal;
            $this->realisasi = $realisasiBelanja->realisasi;
        }
    }

    protected function rules(): array
    {
        return [
            'tanggal' => 'required|date',
            'realisasi' => 'required|numeric',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $anggaran = $this->objekRealisasi->anggaran;
        $sumRealisasi = Realisasi::query()
           ->where('objek_realisasi_id', $this->idObjekRealisasi)
           ->sum('realisasi');

        if ($anggaran < ($this->realisasi + $sumRealisasi)) {
            $this->notification()->error(
                'GAGAL !!!',
                'Gagal menyimpan realisasi. Total realisasi lebih besar dari anggaran.'
            );
        } else {
            if (is_null($this->idRealisasi)) {
                $this->simpanRealisasi();
            } else {
                $this->updateRealisasi($this->idRealisasi);
            }
        }

        return redirect('/realisasi/?tabAktif=realisasi&objekRealisasiId='.$this->idObjekRealisasi);
    }

    public function simpanRealisasi()
    {
        $realisasi = Realisasi::create([
            'objek_realisasi_id' => $this->idObjekRealisasi,
            'tanggal' => $this->tanggal,
            'realisasi' => floatval($this->realisasi),
        ]);

        if (! $realisasi) {
            $this->notification()->error(
                'GAGAL !!!',
                'Gagal menyimpan realisasi.'
            );
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Berhasil menyimpan realisasi.'
            );
            $this->tanggal = null;
            $this->realisasi = null;
        }
    }

    public function updateRealisasi(int $id)
    {
        $realisasi = Realisasi::where('id', $id)->update([
            'objek_realisasi_id' => $this->idObjekRealisasi,
            'tanggal' => $this->tanggal,
            'realisasi' => floatval($this->realisasi),
        ]);

        if (! $realisasi) {
            $this->notification()->error(
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

    public function hapusRealisasi(int $id): void
    {
        Realisasi::destroy($id);
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-form');
    }
}
