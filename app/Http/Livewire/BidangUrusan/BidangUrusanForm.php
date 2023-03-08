<?php

namespace App\Http\Livewire\BidangUrusan;

use App\Models\BidangUrusan;
use App\Models\Urusan;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class BidangUrusanForm extends Component
{
    use WithLiveValidation;

    private ?int $idBidangUrusan = null;
    public int $urusanId;
    public BidangUrusan $bidangUrusan;

    public function mount(int $urusanId, int $id = null): void
    {
        $this->idBidangUrusan = $id;
        $this->bidangUrusan = is_null($id) ? new BidangUrusan() : BidangUrusan::find($id);
        $this->urusanId = $urusanId;
    }

    protected function rules(): array
    {
        return [
            'bidangUrusan.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->bidangUrusan->urusan_id = $this->urusanId;
        $this->bidangUrusan->save();
        return to_route('bidang-urusan', $this->urusanId);
    }

    public function render()
    {
        $urusan = Urusan::find($this->urusanId);
        return view('livewire.bidang-urusan.bidang-urusan-form', compact('urusan'));
    }
}
