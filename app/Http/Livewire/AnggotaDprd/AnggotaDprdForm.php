<?php

namespace App\Http\Livewire\AnggotaDprd;

use App\Models\AnggotaDprd;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class AnggotaDprdForm extends Component
{
    use WithLiveValidation;

    private ?int $idAnggotaDprd = null;

    public AnggotaDprd $anggotaDprd;

    public function mount(int $id = null): void
    {
        $this->idAnggotaDprd = $id;
        $this->anggotaDprd = is_null($id) ? new AnggotaDprd() : AnggotaDprd::find($id);
    }

    protected function rules(): array
    {
        return [
            'anggotaDprd.awal_periode' => 'required|digits:4|integer|min:1900',
            'anggotaDprd.fraksi' => 'required|string|max:255',
            'anggotaDprd.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->anggotaDprd->save();

        return to_route('anggota-dprd');
    }

    public function render()
    {
        return view('livewire.anggota-dprd.anggota-dprd-form');
    }
}
