<?php

namespace App\Http\Livewire\AnggotaDprd;

use App\Models\AnggotaDprd;
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class AnggotaDprdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusAnggotaDprd(int $id): void
    {
        AnggotaDprd::destroy($id);
    }

    public function render()
    {
        $anggotaDprds = AnggotaDprd::query()->pencarian($this->cari)->paginate();

        return view('livewire.anggota-dprd.anggota-dprd-table', compact('anggotaDprds'));
    }
}
