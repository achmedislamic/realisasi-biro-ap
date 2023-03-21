<?php

namespace App\Http\Livewire\BidangUrusan;

use App\Models\BidangUrusan;
use App\Models\Urusan;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class BidangUrusanForm extends Component
{
    use WithLiveValidation;
    use Actions;

    private ?int $idBidangUrusan = null;
    public int $urusanId;
    public BidangUrusan $bidangUrusan;
    public String $buttonText;

    public function mount(int $urusanId, int $id = null): void
    {
        $this->urusanId = $urusanId;

        if (is_null($id)) {
            $this->buttonText = "Simpan";

            $this->idBidangUrusan = $id;
            $this->bidangUrusan =  new BidangUrusan();
        } else {
            $this->buttonText = "Simpan Perubahan";

            $this->idBidangUrusan = $id;
            $this->bidangUrusan = BidangUrusan::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'bidangUrusan.kode' => 'required',
            'bidangUrusan.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->bidangUrusan->urusan_id = $this->urusanId;
        $this->bidangUrusan->save();

        if (is_null($this->idBidangUrusan)) {
            $this->notification()->success(
                'BERHASIL',
                'Data bidang urusan tersimpan.'
            );
            $this->bidangUrusan =  new BidangUrusan();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data bidang urusan diubah.'
            );
        }
    }

    public function render()
    {
        $urusan = Urusan::find($this->urusanId);
        return view('livewire.bidang-urusan.bidang-urusan-form', compact('urusan'));
    }
}
