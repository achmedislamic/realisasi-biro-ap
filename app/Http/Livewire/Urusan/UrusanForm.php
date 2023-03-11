<?php

namespace App\Http\Livewire\Urusan;

use App\Models\Urusan;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class UrusanForm extends Component
{
    use WithLiveValidation;

    private ?int $IdUrusan = null;
    public Urusan $urusan;

    public function mount(int $id = null): void
    {
        $this->IdUrusan = $id;
        $this->urusan = is_null($id) ? new Urusan() : Urusan::find($id);
    }

    protected function rules(): array
    {
        return [
            'urusan.kode' => 'required',
            'urusan.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->urusan->save();
        return to_route('perangkat-daerah');
    }

    public function render()
    {
        return view('livewire.urusan.urusan-form');
    }
}
