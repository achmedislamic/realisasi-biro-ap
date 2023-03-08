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
    public SubOpd $subOpd;

    public function mount(int $idOpd, int $id = null): void
    {
        $this->idSubOpd = $id;
        $this->subOpd = is_null($id) ? new SubOpd() : SubOpd::find($id);
        $this->idOpd = $idOpd;
    }

    protected function rules(): array
    {
        return [
            'subOpd.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->subOpd->opd_id = $this->idOpd;
        $this->subOpd->save();
        return to_route('sub-unit', $this->idOpd);
    }

    public function render()
    {
        $opd = Opd::find($this->idOpd);
        return view('livewire.sub-opd.sub-opd-form', compact('opd'));
    }
}
