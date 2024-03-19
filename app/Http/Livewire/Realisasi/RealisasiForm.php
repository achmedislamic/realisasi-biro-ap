<?php

namespace App\Http\Livewire\Realisasi;

use App\Helpers\FormatHelper;
use App\Models\Jadwal;
use App\Models\{ObjekRealisasi, Realisasi};
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class RealisasiForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public $tanggal;

    public $realisasi;

    public $objekRealisasiId;

    public $idRealisasi = null;

    public $submitText;

    public $opd;

    public $subOpd;

    public $program;

    public $kegiatan;

    public $subKegiatan;

    public $subRincianObjekBelanja;

    public $anggaran;

    public $totalRealisasi;

    public $selisihRealisasi = 0;

    public function mount(int $objekRealisasiId, int $id = null)
    {
        $this->submitText = 'Simpan Realisasi';
        $this->objekRealisasiId = $objekRealisasiId;
        $objekRealisasi = ObjekRealisasi::with('bidangUrusanSubOpd.subOpd.opd')->findOrFail($objekRealisasiId);

        $this->opd = $objekRealisasi->bidangUrusanSubOpd->subOpd->opd->nama;
        $this->subOpd = $objekRealisasi->bidangUrusanSubOpd->subOpd->nama;
        $this->program = $objekRealisasi->subKegiatan->kegiatan->program->nama;
        $this->kegiatan = $objekRealisasi->subKegiatan->kegiatan->nama;
        $this->subKegiatan = $objekRealisasi->subKegiatan->nama;
        $this->subRincianObjekBelanja = $objekRealisasi->subRincianObjekBelanja->nama;
        $this->anggaran = FormatHelper::angka($objekRealisasi->anggaran);

        if (! is_null($id)) {
            $this->idRealisasi = $id;
            $this->submitText = 'Update Realisasi';
            $this->totalRealisasi = Realisasi::query()
                ->where('objek_realisasi_id', $objekRealisasiId)
                ->where('id', '!=', $id)
                ->sum('jumlah');

            $this->realisasi = Realisasi::find($id);
        } elseif (is_null($id)) {
            $this->realisasi = new Realisasi();
            $this->realisasi->tanggal = today()->format('Y-m-d');
            $this->totalRealisasi = Realisasi::where('objek_realisasi_id', $objekRealisasiId)->sum('jumlah');
        }

        $this->totalRealisasi = FormatHelper::angka($this->totalRealisasi);
    }

    private function getJadwal(): ?string
    {
        return Jadwal::where('is_aktif', true)
            ->first()
            ?->tanggal_waktu?->toString();
    }

    protected function rules(): array
    {
        $jadwal = $this->getJadwal();
        return [
            'realisasi.tanggal' => [
                'required',
                'date',
                is_null($jadwal) ? '' : 'before_or_equal:'.$jadwal
            ],
            'realisasi.jumlah' => 'required|numeric|lte:'.ObjekRealisasi::find($this->objekRealisasiId)->selisihRealisasi($this->idRealisasi),
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->realisasi->objek_realisasi_id = $this->objekRealisasiId;

        $this->realisasi->save();

        $this->notification()->success(
            'BERHASIL',
            'Berhasil menyimpan realisasi.'
        );

        return to_route('realisasi', [
            'tabAktif' => 'realisasi',
            'objekRealisasiId' => $this->objekRealisasiId
        ]);
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
