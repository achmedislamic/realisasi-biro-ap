<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\Opd;
use App\Models\SubOpd;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class SubOpdForm extends Component
{
    use WithLiveValidation;

    private ?int $idSubOpd = null;
    public int $idOpd;
    public $idBidangUrusan = 0;
    public SubOpd $subOpd;

    public function mount(int $idOpd, int $idBidangUrusan, int $id = null): void
    {
        $this->idSubOpd = $id;
        $this->subOpd = is_null($id) ? new SubOpd() : SubOpd::find($id);
        $this->idOpd = $idOpd;
        $this->idBidangUrusan = $idBidangUrusan;
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
        return to_route('perangkat-daerah', $this->idOpd);
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
