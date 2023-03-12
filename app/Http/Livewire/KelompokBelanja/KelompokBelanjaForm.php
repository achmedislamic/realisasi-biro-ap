<?php

namespace App\Http\Livewire\KelompokBelanja;

use App\Models\AkunBelanja;
use App\Models\KelompokBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class KelompokBelanjaForm extends Component
{
    use WithLiveValidation;

    private ?int $idKelompokBelanja = null;
    public int $idAkunBelanja;
    public KelompokBelanja $kelompokBelanja;

    public function mount(int $idAkunBelanja, int $id = null): void
    {
        $this->idKelompokBelanja = $id;
        $this->kelompokBelanja = is_null($id) ? new KelompokBelanja() : KelompokBelanja::find($id);
        $this->idAkunBelanja = $idAkunBelanja;
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

        return to_route('rekening');
    }

    public function render()
    {
        $akunBelanja = AkunBelanja::find($this->idAkunBelanja);

        return view('livewire.kelompok-belanja.kelompok-belanja-form', compact('akunBelanja'));
    }
}
