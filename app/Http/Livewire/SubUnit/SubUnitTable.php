<?php

namespace App\Http\Livewire\SubUnit;

use App\Models\Opd;
use App\Models\SubUnit;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubUnitTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idOpd;

    protected $queryString = ['cari' => ['except' => '']];

    public function mount(int $idOpd): void
    {
        $this->idOpd = $idOpd;
    }

    public function hapusSubUnit(int $id): void
    {
        SubUnit::destroy($id);
    }

    public function render()
    {
        $subUnits = SubUnit::query()->where('opd_id', $this->idOpd)->pencarian($this->cari)->paginate();
        $opd = Opd::find($this->idOpd);

        return view('livewire.sub-unit.sub-unit-table', compact(['subUnits', 'opd']));
    }
}
