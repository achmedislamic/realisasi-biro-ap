<?php

namespace App\Http\Livewire\TahapanApbd;

use App\Models\TahapanApbd;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class TahapanApbdForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $IdTahapanApbd = null;

    public TahapanApbd $tahapan;

    public $buttonText = 'Simpan';

    public function mount(int $id = null): void
    {
        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->tahapan = new TahapanApbd();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->IdTahapanApbd = $id;
            $this->tahapan = TahapanApbd::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'tahapan.tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y') + 1),
            'tahapan.nama' => 'required|string|max:255',
            'tahapan.nomor_dpa' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->tahapan->save();

        if (is_null($this->IdTahapanApbd)) {
            $this->notification()->success(
                'BERHASIL',
                'Data tahapan APBD tersimpan.'
            );
            $this->tahapan = new TahapanApbd();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data tahapan APBD diubah.'
            );
        }
    }

    public function render()
    {
        return view('livewire.tahapan-apbd.tahapan-apbd-form');
    }
}
