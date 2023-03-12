<?php

namespace App\Http\Livewire\AkunBelanja;

use App\Models\AkunBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class AkunBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $IdAkunBelanja = null;
    public AkunBelanja $akunBelanja;

    public function mount(int $id = null): void
    {
        $this->IdAkunBelanja = $id;
        $this->akunBelanja = is_null($id) ? new AkunBelanja() : AkunBelanja::find($id);
    }

    protected function rules(): array
    {
        return [
            'akunBelanja.kode' => 'required',
            'akunBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->akunBelanja->save();
        return to_route('rekening');
    }

    public function render()
    {
        return view('livewire.akun-belanja.akun-belanja-form');
    }
}
