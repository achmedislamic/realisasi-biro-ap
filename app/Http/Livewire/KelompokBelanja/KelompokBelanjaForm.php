<?php

namespace App\Http\Livewire\KelompokBelanja;

use App\Models\{AkunBelanja, KelompokBelanja};
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class KelompokBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idKelompokBelanja = null;

    public int $idAkunBelanja;

    public KelompokBelanja $kelompokBelanja;

    public String $buttonText;

    public function mount(int $idAkunBelanja, int $id = null): void
    {
        $this->idAkunBelanja = $idAkunBelanja;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->kelompokBelanja = new KelompokBelanja();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idKelompokBelanja = $id;
            $this->kelompokBelanja = KelompokBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'kelompokBelanja.kode' => 'required',
            'kelompokBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->kelompokBelanja->akun_belanja_id = $this->idAkunBelanja;
        $this->kelompokBelanja->save();

        if (is_null($this->idKelompokBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data kelompok belanja tersimpan.'
            );
            $this->kelompokBelanja = new KelompokBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data kelompok belanja diubah.'
            );
        }
    }

    public function render()
    {
        $akunBelanja = AkunBelanja::find($this->idAkunBelanja);

        return view('livewire.kelompok-belanja.kelompok-belanja-form', compact('akunBelanja'));
    }
}
