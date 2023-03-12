<?php

namespace App\Http\Livewire\SubRincianObjekBelanja;

use App\Models\RincianObjekBelanja;
use App\Models\SubRincianObjekBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class SubRincianObjekBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $idSubRincianObjekBelanja = null;
    public int $idRincianObjekBelanja;
    public SubRincianObjekBelanja $subRincianObjekBelanja;

    public function mount(int $idRincianObjekBelanja, int $id = null): void
    {
        $this->idSubRincianObjekBelanja = $id;
        $this->subRincianObjekBelanja = is_null($id) ? new SubRincianObjekBelanja() : SubRincianObjekBelanja::find($id);
        $this->idRincianObjekBelanja = $idRincianObjekBelanja;
    }

    protected function rules(): array
    {
        return [
            'subRincianObjekBelanja.kode' => 'required',
            'subRincianObjekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->subRincianObjekBelanja->rincian_objek_belanja_id = $this->idRincianObjekBelanja;
        $this->subRincianObjekBelanja->save();

        return to_route('rekening');
    }

    public function render()
    {
        $rincianObjekBelanja = RincianObjekBelanja::find($this->idRincianObjekBelanja);

        return view('livewire.sub-rincian-objek-belanja.sub-rincian-objek-belanja-form', compact('rincianObjekBelanja'));
    }
}
