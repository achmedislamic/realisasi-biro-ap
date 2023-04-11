<?php

namespace App\Http\Livewire\Opd;

use App\Models\{BidangUrusan, Opd};
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class OpdForm extends Component
{
    use Actions, WithLiveValidation;

    public ?int $idOpd = null;

    public int $idBidangUrusan;

    public Opd $opd;

    public String $buttonText;

    public function mount(int $idBidangUrusan, int $id = null): void
    {
        $this->idBidangUrusan = $idBidangUrusan;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->opd = new Opd();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idOpd = $id;
            $this->opd = Opd::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'opd.kode' => 'required',
            'opd.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->opd->save();

        $this->notification()->success(
            'BERHASIL',
            'Data OPD tersimpan.'
        );

        $this->opd = new Opd();

        // if ($this->opd->id) {
        //     $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);
        //     $bidangUrusan->opds()->attach($this->opd->id);
        // }

        // if (is_null($this->idOpd)) {

        // } else {
        //     $this->notification()->success(
        //         'BERHASIL',
        //         'Data OPD diubah.'
        //     );
        // }
    }

    public function render()
    {
        $bidangUrusan = BidangUrusan::find($this->idBidangUrusan);

        return view('livewire.opd.opd-form', compact('bidangUrusan'));
    }
}
