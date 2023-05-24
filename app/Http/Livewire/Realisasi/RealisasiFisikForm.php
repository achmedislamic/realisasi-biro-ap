<?php

namespace App\Http\Livewire\Realisasi;

use App\Helpers\FormatHelper;
use App\Models\Jadwal;
use App\Models\{ObjekRealisasi, RealisasiFisik};
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class RealisasiFisikForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public $tanggal;

    public $realisasiFisik;

    public $objekRealisasiId;

    public $idRealisasi = null;

    public $submitText;

    public ObjekRealisasi $objekRealisasi;

    public $pod;

    public $subOpd;

    public $program;

    public $kegiatan;

    public $subKegiatan;

    public $subRincianObjekBelanja;

    public $target;

    public $totalRealisasi;

    public $selisihRealisasi = 0;

    public function mount(int $objekRealisasiId, int $id = null)
    {
        $this->submitText = 'Simpan';
        $this->objekRealisasiId = $objekRealisasiId;
        $this->objekRealisasi = ObjekRealisasi::with(['bidangUrusanSubOpd.subOpd.opd', 'satuan'])->find($objekRealisasiId);

        $this->pod = $this->objekRealisasi->bidangUrusanSubOpd->subOpd->opd->nama;
        $this->subOpd = $this->objekRealisasi->bidangUrusanSubOpd->subOpd->nama;
        $this->program = $this->objekRealisasi->subKegiatan->kegiatan->program->nama;
        $this->kegiatan = $this->objekRealisasi->subKegiatan->kegiatan->nama;
        $this->subKegiatan = $this->objekRealisasi->subKegiatan->nama;
        $this->subRincianObjekBelanja = $this->objekRealisasi->subRincianObjekBelanja->nama;
        $this->target = FormatHelper::angka($this->objekRealisasi->target);

        if (! is_null($id)) {
            $this->idRealisasi = $id;
            $this->submitText = 'Update Realisasi';
            $this->totalRealisasi = RealisasiFisik::query()
                ->where('objek_realisasi_id', $objekRealisasiId)
                ->where('id', '!=', $id)
                ->sum('jumlah');

            $this->realisasiFisik = RealisasiFisik::find($id);
        } elseif (is_null($id)) {
            $this->realisasiFisik = new RealisasiFisik();
            $this->realisasiFisik->tanggal = today()->format('Y-m-d');
            $this->totalRealisasi = RealisasiFisik::where('objek_realisasi_id', $objekRealisasiId)->sum('jumlah');
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
            'realisasiFisik.tanggal' => [
                'required',
                'date',
                is_null($jadwal) ? '' : 'before_or_equal:'.$jadwal
            ],
            'realisasiFisik.jumlah' => 'required|numeric|lte:'.ObjekRealisasi::find($this->objekRealisasiId)->selisihRealisasiFisik($this->idRealisasi),
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->realisasiFisik->objek_realisasi_id = $this->objekRealisasiId;

        $this->realisasiFisik->save();

        $this->notification()->success(
            'BERHASIL',
            'Berhasil menyimpan realisasi fisik.'
        );

        return to_route('realisasi', [
            'tabAktif' => 'realisasi',
            'objekRealisasiId' => $this->objekRealisasiId
        ]);
    }

    public function hapusRealisasi(int $id): void
    {
        RealisasiFisik::destroy($id);
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-fisik-form');
    }
}
