<?php

namespace App\Http\Livewire\AkunBelanja;

use App\Models\AkunBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class AkunBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $IdAkunBelanja = null;
    public AkunBelanja $akunBelanja;
    public String $buttonText;

    public function mount(int $id = null): void
    {
        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->akunBelanja = new AkunBelanja();
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->IdAkunBelanja = $id;
            $this->akunBelanja = AkunBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'akunBelanja.kode' => 'required',
            'akunBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->akunBelanja->save();

        if (is_null($this->IdAkunBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data akun belanja tersimpan.'
            );
            $this->akunBelanja =  new AkunBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data akun belanja diubah.'
            );
        }
    }

    public function render()
    {
        return view('livewire.akun-belanja.akun-belanja-form');
    }
}
