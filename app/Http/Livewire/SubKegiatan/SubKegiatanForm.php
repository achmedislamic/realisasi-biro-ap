<?php

namespace App\Http\Livewire\SubKegiatan;

use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class SubKegiatanForm extends Component
{
    use WithLiveValidation;

    private ?int $idSubKegiatan = null;
    public int $idKegiatan;
    public SubKegiatan $subKegiatan;

    public function mount(int $idKegiatan, int $id = null): void
    {
        $this->idSubKegiatan = $id;
        $this->subKegiatan = is_null($id) ? new SubKegiatan() : SubKegiatan::find($id);
        $this->idKegiatan = $idKegiatan;
    }

    protected function rules(): array
    {
        return [
            'subKegiatan.kode' => 'required',
            'subKegiatan.nama' => 'required|string|max:255',
        ];
    }

       public function simpan()
       {
           $this->validate();
           $this->subKegiatan->kegiatan_id = $this->idKegiatan;
           $this->subKegiatan->save();

           return to_route('program-kegiatan');
       }

    public function render()
    {
        $kegiatan = Kegiatan::first();

        return view('livewire.sub-kegiatan.sub-kegiatan-form', compact(['kegiatan']));
    }
}
