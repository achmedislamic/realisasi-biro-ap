<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\Opd;
use App\Models\SubOpd;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubOpdTable extends Component
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

    public function hapusSubOpd(int $id): void
    {
        SubOpd::destroy($id);
    }

    public function render()
    {
        $subOpds = SubOpd::query()
            ->where('opd_id', $this->idOpd)
            ->pencarian($this->cari)
            ->paginate();

        $opd = Opd::find($this->idOpd);

        return view('livewire.sub-unit.sub-unit-table', compact('subOpds', 'opd'));
    }
}
