<?php

namespace App\Http\Livewire\TahapanAPBD;

use Livewire\Component;
use App\Traits\Pencarian;
use WireUi\Traits\Actions;
use App\Models\TahapanAPBD;
use Livewire\WithPagination;

class TahapanAPBDTable extends Component
{

    use Pencarian, WithPagination, Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusTahapanAPBD(int $id): void
    {
        TahapanAPBD::destroy($id);
    }

    public function render()
    {
        $tahapan_apbds = TahapanAPBD::query()->pencarian($this->cari)->paginate();

        return view('livewire.tahapan-apbd.tahapan-apbd-table', compact('tahapan_apbds'));
    }
}
