<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use App\Traits\WithLiveValidation;
use Illuminate\View\View;
use Livewire\Component;

class SatuanForm extends Component
{
    use WithLiveValidation;

    private ?int $idSatuan = null;

    public Satuan $satuan;

    public function mount(int $id = null): void
    {
        $this->idSatuan = $id;
        $this->satuan = is_null($id) ? new Satuan() : Satuan::find($id);
    }

    public function simpan()
    {
        $this->validate([
            'satuan.nama' => 'required|string|max:255',
        ]);

        $this->satuan->save();

        return to_route('satuan');
    }

    public function render(): view
    {
        return view('livewire.satuan.satuan-form');
    }
}
