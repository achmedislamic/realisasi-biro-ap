<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\{BidangUrusan, Opd, SubOpd};
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
            $this->buttonText = 'Simpan';
            $this->subOpd = new SubOpd();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idSubOpd = $id;
            $this->subOpd = SubOpd::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'subOpd.kode' => 'required',
            'subOpd.nama' => 'required|string|max:255',
            'subOpd.nama_kepala' => 'required|max:255',
            'subOpd.nip_kepala' => 'required|max:25'
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->subOpd->opd_id = $this->idOpd;

        $this->subOpd->save();

        $this->notification()->success(
            'BERHASIL',
            'Data Sub OPD tersimpan.'
        );

        return redirect()->back();
    }

    public function render()
    {
        $opd = Opd::find($this->idOpd);
        $bidangUrusan = BidangUrusan::with('urusan')->find($this->idBidangUrusan);

        return view('livewire.sub-opd.sub-opd-form', compact('opd', 'bidangUrusan'));
    }
}
