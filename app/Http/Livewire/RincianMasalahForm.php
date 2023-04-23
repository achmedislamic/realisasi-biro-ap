<?php

namespace App\Http\Livewire;

use App\Models\{ObjekRealisasi, Realisasi, RincianMasalah, SubKegiatan, SubOpd};
use Livewire\Component;

class RincianMasalahForm extends Component
{
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
            'rincianMasalah.tindak_lanjut' => 'required|string',
            'rincianMasalah.pihak' => 'required|max:255',
        ];
    }

    public function updatedTriwulan($value)
    {
        $this->rincianMasalah = RincianMasalah::query()
            ->where('sub_kegiatan_id', $this->subKegiatan->id)
            ->where('sub_opd_id', $this->subOpd->id)
            ->where('triwulan', $value)
            ->first();

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
