<?php

namespace App\Http\Livewire;

use App\Models\{ObjekRealisasi, Realisasi, RincianMasalah, SubKegiatan, SubOpd};
use Livewire\Component;
use WireUi\Traits\Actions;

class RincianMasalahForm extends Component
{
    use Actions;

    public $subKegiatan;

    public $subOpd;

    public $rincianMasalah;

    public $triwulan;

    public $jumlahAnggaran = null;

    public $jumlahRealisasi = null;

    public function mount(int $subKegiatan, int $subOpd): void
    {
        $this->subKegiatan = SubKegiatan::with('kegiatan.program')->find($subKegiatan);
        $this->subOpd = SubOpd::with('opd')->find($subOpd);
        $this->rincianMasalah = new RincianMasalah();
        $this->jumlahAnggaran = ObjekRealisasi::where('sub_kegiatan_id', $this->subKegiatan->id)
            ->whereRelation('bidangUrusanSubOpd', 'sub_opd_id', $this->subOpd->id)
            ->sum('anggaran');
    }

    protected function rules(): array
    {
        return [
            'triwulan' => 'required|numeric',
            'rincianMasalah.kendala' => 'required|string',
            'triwulan' => 'required|numeric',
            'rincianMasalah.tindak_lanjut' => 'required|string',
            'rincianMasalah.pihak' => 'required|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->rincianMasalah->tahun = cache('tahapanApbd')->tahun;
        $this->rincianMasalah->sub_opd_id = $this->subOpd->id;
        $this->rincianMasalah->sub_kegiatan_id = $this->subKegiatan->id;
        $this->rincianMasalah->triwulan = $this->triwulan;
        $this->rincianMasalah->save();

        $this->notification()->success(title: 'Rincian Masalah', description: 'Berhasil disimpan!');

        return redirect("/realisasi?tabAktif=subKegiatan&opdPilihan={$this->subOpd->opd_id}&programId={$this->subKegiatan->kegiatan->program_id}&kegiatanId={$this->subKegiatan->kegiatan->id}");
    }

    public function updatedTriwulan($value)
    {
        $this->rincianMasalah = RincianMasalah::query()
            ->where('sub_kegiatan_id', $this->subKegiatan->id)
            ->where('sub_opd_id', $this->subOpd->id)
            ->where('triwulan', $value)
            ->firstOrNew();

        $this->jumlahRealisasi = Realisasi::whereRelation('objekRealisasi.bidangUrusanSubOpd', 'sub_opd_id', $this->subOpd->id)
            ->whereHas('objekRealisasi', function ($query) {
                $query->where('sub_kegiatan_id', $this->subKegiatan->id)
                    ->where('tahapan_apbd_id', cache('tahapanApbd')->id);
            })
            ->sum('jumlah');
    }

    public function render()
    {
        return view('livewire.rincian-masalah-form');
    }
}
