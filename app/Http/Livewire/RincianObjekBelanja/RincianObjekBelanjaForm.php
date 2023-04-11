<?php

namespace App\Http\Livewire\RincianObjekBelanja;

use App\Models\{ObjekBelanja, RincianObjekBelanja};
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class RincianObjekBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idRincianObjekBelanja = null;

    public int $idObjekBelanja;

    public RincianObjekBelanja $rincianObjekBelanja;

    public String $buttonText;

    public function mount(int $idObjekBelanja, int $id = null): void
    {
        $this->idObjekBelanja = $idObjekBelanja;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->rincianObjekBelanja = new RincianObjekBelanja();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idRincianObjekBelanja = $id;
            $this->rincianObjekBelanja = RincianObjekBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'rincianObjekBelanja.kode' => 'required',
            'rincianObjekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->rincianObjekBelanja->objek_belanja_id = $this->idObjekBelanja;
        $this->rincianObjekBelanja->save();

        if (is_null($this->idRincianObjekBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data rincian objek belanja tersimpan.'
            );
            $this->rincianObjekBelanja = new RincianObjekBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data rincian objek belanja diubah.'
            );
        }
    }

    public function render()
    {
        $objekBelanja = ObjekBelanja::find($this->idObjekBelanja);

        return view('livewire.rincian-objek-belanja.rincian-objek-belanja-form', compact('objekBelanja'));
    }
}
