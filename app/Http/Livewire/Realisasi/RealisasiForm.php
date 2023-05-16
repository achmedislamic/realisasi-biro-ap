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

    public ObjekRealisasi $objekRealisasi;

    public $pod;

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
        $this->objekRealisasi = ObjekRealisasi::with('bidangUrusanSubOpd.subOpd.opd')->find($objekRealisasiId);

        $this->pod = $this->objekRealisasi->bidangUrusanSubOpd->subOpd->opd->nama;
        $this->subOpd = $this->objekRealisasi->bidangUrusanSubOpd->subOpd->nama;
        $this->program = $this->objekRealisasi->subKegiatan->kegiatan->program->nama;
        $this->kegiatan = $this->objekRealisasi->subKegiatan->kegiatan->nama;
        $this->subKegiatan = $this->objekRealisasi->subKegiatan->nama;
        $this->subRincianObjekBelanja = $this->objekRealisasi->subRincianObjekBelanja->nama;
        $this->anggaran = FormatHelper::angka($this->objekRealisasi->anggaran);

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
            $this->totalRealisasi = Realisasi::where('objek_realisasi_id', $objekRealisasiId)->sum('jumlah');
        }

        $this->totalRealisasi = FormatHelper::angka($this->totalRealisasi);
    }

    private function getJadwal(): string
    {
        return Jadwal::where('is_aktif', true)
            ->first()
            ->tanggal_waktu->toString();
    }

    protected function rules(): array
    {
        return [
            'realisasi.tanggal_waktu' => [
                'required',
                'date',
                'date_format:d F Y mm:ss',
                'after_or_equal:'.$this->getJadwal(),
            ],
            'realisasi.jumlah' => 'required|numeric|lte:'.ObjekRealisasi::find($this->objekRealisasiId)->selisihRealisasi($this->idRealisasi),
        ];
    }

    public function simpan()
    {
        $temp = $this->realisasi->tanggal_waktu;
        $this->realisasi->tanggal_waktu = FormatHelper::tanggal($this->realisasi->tanggal_waktu, true);
        dd($this->realisasi->tanggal_waktu);

        $this->validate();

        $this->realisasi->objek_realisasi_id = $this->objekRealisasiId;
        $this->realisasi->tanggal_waktu = $temp;

        $this->realisasi->save();

        $this->notification()->success(
            'BERHASIL',
            'Berhasil menyimpan realisasi.'
        );

        return redirect('/realisasi/?tabAktif=realisasi&objekRealisasiId='.$this->objekRealisasiId);
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
