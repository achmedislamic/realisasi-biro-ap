<?php

namespace App\Http\Livewire\SumberDana;

use App\Models\SumberDana;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class SumberDanaForm extends Component
{
    use WithLiveValidation;

    private ?int $sumberDanaId = null;

    public SumberDana $sumberDana;

    public function mount(int $id = null): void
    {
        $this->sumberDanaId = $id;
        $this->sumberDana = is_null($id) ? new SumberDana : SumberDana::find($id);
    }

    protected function rules(): array
    {
        return [
            'sumberDana.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->sumberDana->save();

        return to_route('sumber-dana');
    }

    public function render()
    {
        return view('livewire.sumber-dana.sumber-dana-form');
    }
}
