<?php

namespace App\Http\Livewire\TahapanApbd;

use Livewire\Component;
use App\Traits\Pencarian;
use WireUi\Traits\Actions;
use App\Models\TahapanApbd;
use Livewire\WithPagination;

class TahapanApbdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusTahapanApbd(int $id): void
    {
        TahapanApbd::destroy($id);
    }

    public function render()
    {
        $tahapanApbds = TahapanApbd::query()->pencarian($this->cari)->paginate();

        return view('livewire.tahapan-apbd.tahapan-apbd-table', compact('tahapanApbds'));
    }
}
