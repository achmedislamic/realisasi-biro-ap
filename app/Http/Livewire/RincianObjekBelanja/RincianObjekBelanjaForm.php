<?php

namespace App\Http\Livewire\RincianObjekBelanja;

use App\Models\ObjekBelanja;
use App\Models\RincianObjekBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class RincianObjekBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $idRincianObjekBelanja = null;
    public int $idObjekBelanja;
    public RincianObjekBelanja $rincianObjekBelanja;

    public function mount(int $idObjekBelanja, int $id = null): void
    {
        $this->idRincianObjekBelanja = $id;
        $this->rincianObjekBelanja = is_null($id) ? new RincianObjekBelanja() : RincianObjekBelanja::find($id);
        $this->idObjekBelanja = $idObjekBelanja;
    }

    protected function rules(): array
    {
        return [
            'rincianObjekBelanja.kode' => 'required',
            'rincianObjekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->rincianObjekBelanja->objek_belanja_id = $this->idObjekBelanja;
        $this->rincianObjekBelanja->save();

        return to_route('rekening');
    }

    public function render()
    {
        $objekBelanja = ObjekBelanja::find($this->idObjekBelanja);

        return view('livewire.rincian-objek-belanja.rincian-objek-belanja-form', compact('objekBelanja'));
    }
}
