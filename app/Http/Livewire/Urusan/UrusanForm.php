<?php

namespace App\Http\Livewire\Urusan;

use App\Models\Urusan;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class UrusanForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $IdUrusan = null;
    public Urusan $urusan;
    public String $buttonText;

    public function mount(int $id = null): void
    {
        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->urusan =  new Urusan();
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->IdUrusan = $id;
            $this->urusan = Urusan::find($id);
        }
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

        if (is_null($this->IdUrusan)) {
            $this->notification()->success(
                'BERHASIL',
                'Data Urusan tersimpan.'
            );
            $this->urusan =  new Urusan();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data Urusan diubah.'
            );
        }
    }

    public function render()
    {
        return view('livewire.urusan.urusan-form');
    }
}
