<?php

namespace App\Http\Livewire\ObjekBelanja;

use App\Models\JenisBelanja;
use App\Models\ObjekBelanja;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use PhpParser\Node\Expr\Cast\Object_;
use WireUi\Traits\Actions;

class ObjekBelanjaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idObjekBelanja = null;
    public int $idJenisBelanja;
    public ObjekBelanja $objekBelanja;
    public String $buttonText;

    public function mount(int $idJenisBelanja, int $id = null): void
    {
        $this->idJenisBelanja = $idJenisBelanja;

        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->objekBelanja = new ObjekBelanja();
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->idObjekBelanja = $id;
            $this->objekBelanja = ObjekBelanja::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'objekBelanja.kode' => 'required',
            'objekBelanja.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->objekBelanja->jenis_belanja_id = $this->idJenisBelanja;
        $this->objekBelanja->save();

        if (is_null($this->idObjekBelanja)) {
            $this->notification()->success(
                'BERHASIL',
                'Data objek belanja tersimpan.'
            );
            $this->objekBelanja = new ObjekBelanja();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data objek belanja diubah.'
            );
        }
    }

    public function render()
    {
        $jenisBelanja = JenisBelanja::find($this->idJenisBelanja);

        return view('livewire.objek-belanja.objek-belanja-form', compact('jenisBelanja'));
    }
}
