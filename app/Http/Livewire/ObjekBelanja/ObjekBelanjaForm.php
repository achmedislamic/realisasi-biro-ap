<?php

namespace App\Http\Livewire\ObjekBelanja;

use App\Models\JenisBelanja;
use App\Models\ObjekBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class ObjekBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $idObjekBelanja = null;
    public int $idJenisBelanja;
    public ObjekBelanja $objekBelanja;

    public function mount(int $idJenisBelanja, int $id = null): void
    {
        $this->idObjekBelanja = $id;
        $this->objekBelanja = is_null($id) ? new ObjekBelanja() : ObjekBelanja::find($id);
        $this->idJenisBelanja = $idJenisBelanja;
    }

    protected function rules(): array
    {
        return [
            'objekBelanja.kode' => 'required',
            'objekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->objekBelanja->jenis_belanja_id = $this->idJenisBelanja;
        $this->objekBelanja->save();

        return to_route('rekening');
    }

    public function render()
    {
        $jenisBelanja = JenisBelanja::find($this->idJenisBelanja);

        return view('livewire.objek-belanja.objek-belanja-form', compact('jenisBelanja'));
    }
}
