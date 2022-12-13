<?php

namespace App\Http\Livewire\TahapanApbd;

use App\Models\TahapanApbd;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class TahapanApbdForm extends Component
{
    use WithLiveValidation;

    private ?int $IdTahapanApbd = null;
    public TahapanApbd $tahapan;

    public function mount(int $id = null): void
    {
        $this->IdTahapanApbd = $id;
        $this->tahapan = is_null($id) ? new TahapanApbd() : TahapanApbd::find($id);
    }

    protected function rules(): array
    {
        return [
            'tahapan.nama' => 'required|string|max:255',
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
