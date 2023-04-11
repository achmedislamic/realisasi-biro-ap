<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class PekerjaanForm extends Component
{
    use WithLiveValidation;

    private ?int $idPekerjaan = null;

    public Pekerjaan $pekerjaan;

    public function mount(int $id = null): void
    {
        $this->idPekerjaan = $id;
        $this->pekerjaan = is_null($id) ? new Pekerjaan() : Pekerjaan::find($id);
    }

    protected function rules(): array
    {
        return [
            'pekerjaan.nama' => 'required|string|max:255',
            'pekerjaan.volume' => 'required|numeric',
            'pekerjaan.satuan' => 'required|string|max:50',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->pekerjaan->save();

        return to_route('pekerjaan');
    }

    public function render()
    {
        return view('livewire.pekerjaan.pekerjaan-form');
    }
}
