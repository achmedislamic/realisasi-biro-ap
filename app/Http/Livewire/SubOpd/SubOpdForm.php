<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\Opd;
use App\Models\SubOpd;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class SubOpdForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idSubOpd = null;
    public int $idOpd;
    public $idBidangUrusan = 0;
    public SubOpd $subOpd;
    public String $buttonText;

    public function mount(int $idOpd, int $idBidangUrusan, int $id = null): void
    {
        $this->idOpd = $idOpd;
        $this->idBidangUrusan = $idBidangUrusan;

        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->subOpd =  new SubOpd() ;
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->idSubOpd = $id;
            $this->subOpd = SubOpd::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'subOpd.kode' => 'required',
            'subOpd.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->subOpd->opd_id = $this->idOpd;
        $this->subOpd->save();

        if (is_null($this->idSubOpd)) {
            $this->notification()->success(
                'BERHASIL',
                'Data sub OPD tersimpan.'
            );
            $this->subOpd =  new SubOpd();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data sub OPD diubah.'
            );
        }
    }

    public function render()
    {
        $opd = Opd::query()
            ->with('bidangUrusans')
            ->whereHas('bidangUrusans')
            ->whereBidangUrusanId($this->idBidangUrusan)
            ->find($this->idOpd);

        return view('livewire.sub-opd.sub-opd-form', compact('opd'));
    }
}
