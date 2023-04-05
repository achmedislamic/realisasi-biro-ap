<?php

namespace App\Http\Livewire\JenisBelanja;

use App\Models\{JenisBelanja, KelompokBelanja};
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class JenisBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idJenisBelanja = null;

    public int $idKelompokBelanja;

    public JenisBelanja $jenisBelanja;

    public String $buttonText;

    public function mount(int $idKelompokBelanja, int $id = null): void
    {
        $this->idKelompokBelanja = $idKelompokBelanja;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->jenisBelanja = new JenisBelanja();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idJenisBelanja = $id;
            $this->jenisBelanja = JenisBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'jenisBelanja.kode' => 'required',
            'jenisBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->jenisBelanja->kelompok_belanja_id = $this->idKelompokBelanja;
        $this->jenisBelanja->save();

        if (is_null($this->idJenisBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data jenis belanja tersimpan.'
            );
            $this->jenisBelanja = new JenisBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data jenis belanja diubah.'
            );
        }
    }

    public function render()
    {
        $kelompokBelanja = KelompokBelanja::find($this->idKelompokBelanja);

        return view('livewire.jenis-belanja.jenis-belanja-form', compact('kelompokBelanja'));
    }
}
