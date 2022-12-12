<?php

namespace App\Http\Livewire\TahapanAPBD;

use App\Models\TahapanAPBD;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class TahapanAPBDForm extends Component
{
    use WithLiveValidation;

    private ?int $IdTahapanAPBD = null;
    public TahapanAPBD $tahapan;

    public function mount(int $id = null): void
    {
        $this->IdTahapanAPBD = $id;
        $this->tahapan = is_null($id) ? new TahapanAPBD() : TahapanAPBD::find($id);
    }

    protected function rules(): array
    {
        return [
            'tahapan.nama_tahapan' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->tahapan->save();

        return to_route('tahapan-apbd');
    }

    public function render()
    {
        return view('livewire.tahapan-apbd.tahapan-apbd-form');
    }
}
