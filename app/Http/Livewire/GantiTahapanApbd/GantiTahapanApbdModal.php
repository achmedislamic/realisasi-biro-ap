<?php

namespace App\Http\Livewire\GantiTahapanApbd;

use App\Models\TahapanApbd;
use Illuminate\Support\Facades\Cookie;
use LivewireUI\Modal\ModalComponent;

use function PHPUnit\Framework\isEmpty;

class GantiTahapanApbdModal extends ModalComponent
{
    public $idTahapanPilihan = null;
    public $tahunTahapanPilihan = null;

    public $tahunTahapans;
    public $namaTahapans;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public function mount()
    {
        $tahapan = TahapanApbd::find(Cookie::get('TAID'));
        $this->idTahapanPilihan = Cookie::get('TAID');
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
             'tahunTahapanPilihan' => 'required'
        ];
    }

    public function gantiTahapanApbd()
    {
        if ($this->idTahapanPilihan !== "") {
            Cookie::queue(Cookie::forever("TAID", $this->idTahapanPilihan));
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
