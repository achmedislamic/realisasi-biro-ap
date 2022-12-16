<?php

namespace App\Http\Livewire;

use App\Models\Satuan;
use Livewire\Component;
use App\Traits\WithLiveValidation;
use Illuminate\View\View;
use PhpParser\Node\Expr\FuncCall;

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

    protected function rules(): array
    {
        return [
            'satuan.nama' => 'required|string|max:255',
            'satuan.satuan' => 'required|string|max:50',
        ];
    }

    public function simpan() {
        $this->validate();
        $this->satuan->save();
        return to_route('satuan');
    }



    public function render(): view
    {
        return view('livewire.satuan-form');
    }
}
