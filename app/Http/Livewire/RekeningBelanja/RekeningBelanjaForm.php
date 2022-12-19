<?php

namespace App\Http\Livewire\RekeningBelanja;

use App\Models\RekeningBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class RekeningBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $IdRekeningBelanja = null;
    public RekeningBelanja $rekening;

    public function mount(int $id = null): void
    {
        $this->IdRekeningBelanja = $id;
        $this->rekening = is_null($id) ? new RekeningBelanja() : RekeningBelanja::find($id);
    }

    protected function rules(): array
    {
        return [
            'rekening.kode' => 'required|string|max:15',
            'rekening.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->rekening->save();

        return to_route('rekening-belanja');
    }

    public function render()
    {
        return view('livewire.rekening-belanja.rekening-belanja-form');
    }
}
