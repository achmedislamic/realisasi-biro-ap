<?php

namespace App\Http\Livewire\JenisBelanja;

use App\Models\JenisBelanja;
use App\Models\KelompokBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class JenisBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $idJenisBelanja = null;
    public int $idKelompokBelanja;
    public JenisBelanja $jenisBelanja;

    public function mount(int $idKelompokBelanja, int $id = null): void
    {
        $this->idJenisBelanja = $id;
        $this->jenisBelanja = is_null($id) ? new JenisBelanja() : JenisBelanja::find($id);
        $this->idKelompokBelanja = $idKelompokBelanja;
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

        return to_route('rekening');
    }

    public function render()
    {
        $kelompokBelanja = KelompokBelanja::find($this->idKelompokBelanja);

        return view('livewire.jenis-belanja.jenis-belanja-form', compact('kelompokBelanja'));
    }
}
