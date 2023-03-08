<?php

namespace App\Http\Livewire\Opd;

use App\Models\BidangUrusan;
use App\Models\Opd;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class OpdForm extends Component
{
    use WithLiveValidation;

    private ?int $idOpd = null;
    public int $idBidangUrusan;
    public Opd $opd;

    public function mount(int $idBidangUrusan, int $id = null): void
    {
        $this->idOpd = $id;
        $this->opd = is_null($id) ? new Opd() : Opd::find($id);
        $this->idBidangUrusan = $idBidangUrusan;
    }

    protected function rules(): array
    {
        return [
            'opd.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->opd->bidang_urusan_id = $this->idBidangUrusan;
        $this->opd->save();
        return to_route('opd', $this->idBidangUrusan);
    }

    public function render()
    {
        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);
        return view('livewire.opd.opd-form', compact('bidangUrusan'));
    }
}
