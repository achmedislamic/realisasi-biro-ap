<?php

namespace App\Http\Livewire\GantiTahapanApbd;

use App\Models\TahapanApbd;
use LivewireUI\Modal\ModalComponent;

class GantiTahapanApbdModal extends ModalComponent
{
    public $idTahapanPilihan = null;

    public $tahunTahapanPilihan = null;

    public $tahunTahapans;

    public $namaTahapans;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $tahapan = cache('tahapanApbd');
        $this->idTahapanPilihan = $tahapan->id;
        $this->tahunTahapanPilihan = $tahapan->tahun;

        $this->tahunTahapans = collect(TahapanApbd::query()
            ->orderByDesc('tahun')
            ->get())->unique('tahun')->values()->all();

        $this->namaTahapans = collect(TahapanApbd::query()
            ->where('tahun', $tahapan->tahun)
            ->get());
    }

    public function rules()
    {
        return [
            'idTahapanPilihan' => 'required',
            'tahunTahapanPilihan' => 'required',
        ];
    }

    public function gantiTahapanApbd()
    {
        if ($this->idTahapanPilihan !== '') {
            cache()->forget('tahapanApbd');
            cache()->forever('tahapanApbd', TahapanApbd::find($this->idTahapanPilihan));

            return redirect()->route('dashboard');
        }
    }

    public function updatedTahunTahapanPilihan($tahun)
    {
        $this->tahunTahapans = collect(TahapanApbd::query()
        ->orderByDesc('tahun')
        ->get())->unique('tahun')->values()->all();

        $this->namaTahapans = collect(TahapanApbd::query()
            ->where('tahun', $tahun)
            ->get());
    }

    public function render()
    {
        return view('livewire.ganti-tahapan-apbd.ganti-tahapan-apbd-modal');
    }
}
