<?php

namespace App\Http\Livewire\SubKegiatan;

use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class SubKegiatanForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idSubKegiatan = null;
    public int $idKegiatan;
    public SubKegiatan $subKegiatan;
    public String $buttonText;

    public function mount(int $idKegiatan, int $id = null): void
    {
        $this->idKegiatan = $idKegiatan;

        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->subKegiatan = new SubKegiatan();
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->idSubKegiatan = $id;
            $this->subKegiatan = SubKegiatan::find($id);
        }
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

        if (is_null($this->idSubKegiatan)) {
            $this->notification()->success(
                'BERHASIL',
                'Data sub kegiatan tersimpan.'
            );
            $this->subKegiatan = new SubKegiatan();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data sub kegiatan diubah.'
            );
        }
    }

    public function render()
    {
        $kegiatan = Kegiatan::first();

        return view('livewire.sub-kegiatan.sub-kegiatan-form', compact(['kegiatan']));
    }
}
