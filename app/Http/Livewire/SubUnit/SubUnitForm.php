<?php

namespace App\Http\Livewire\SubUnit;

use App\Models\Opd;
use App\Models\SubUnit;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class SubUnitForm extends Component
{
    use WithLiveValidation;

    private ?int $idSubUnit = null;
    public int $idOpd;
    public SubUnit $subUnit;

    public function mount(int $idOpd, int $id = null): void
    {
        $this->idSubUnit = $id;
        $this->subUnit = is_null($id) ? new SubUnit() : SubUnit::find($id);
        $this->idOpd = $idOpd;
    }

    protected function rules(): array
    {
        return [
            'subUnit.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();
        $this->subUnit->opd_id = $this->idOpd;
        $this->subUnit->save();
        return to_route('sub-unit', $this->idOpd);
    }

    public function render()
    {
        $opd = Opd::find($this->idOpd);
        return view('livewire.sub-unit.sub-unit-form', compact('opd'));
    }
}
