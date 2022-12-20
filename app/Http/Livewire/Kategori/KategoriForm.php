<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class KategoriForm extends Component
{
    use WithLiveValidation;

    private ?int $idKategori = null;
    public Kategori $kategori;

    public function mount(int $id = null): void
    {
        $this->idKategori = $id;
        $this->kategori = is_null($id) ? new Kategori() : Kategori::find($id);
    }

    protected function rules(): array
    {
        return [
            'kategori.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->kategori->save();

        return to_route('kategori');
    }

    public function render()
    {
        return view('livewire.kategori.kategori-form');
    }
}
