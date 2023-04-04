<?php

namespace App\Http\Livewire\SubRincianObjekBelanja;

use App\Models\RincianObjekBelanja;
use App\Models\SubRincianObjekBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class SubRincianObjekBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idSubRincianObjekBelanja = null;

    public int $idRincianObjekBelanja;

    public SubRincianObjekBelanja $subRincianObjekBelanja;

    public String $buttonText;

    public function mount(int $idRincianObjekBelanja, int $id = null): void
    {
        $this->idRincianObjekBelanja = $idRincianObjekBelanja;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->subRincianObjekBelanja = new SubRincianObjekBelanja();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idSubRincianObjekBelanja = $id;
            $this->subRincianObjekBelanja = SubRincianObjekBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'subRincianObjekBelanja.kode' => 'required',
            'subRincianObjekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->subRincianObjekBelanja->rincian_objek_belanja_id = $this->idRincianObjekBelanja;
        $this->subRincianObjekBelanja->save();

        if (is_null($this->idSubRincianObjekBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data sub rincian objek belanja tersimpan.'
            );
            $this->subRincianObjekBelanja = new SubRincianObjekBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data sub rincian objek belanja diubah.'
            );
        }
    }

    public function render()
    {
        $rincianObjekBelanja = RincianObjekBelanja::find($this->idRincianObjekBelanja);

        return view('livewire.sub-rincian-objek-belanja.sub-rincian-objek-belanja-form', compact('rincianObjekBelanja'));
    }
}
