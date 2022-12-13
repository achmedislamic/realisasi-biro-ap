<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class PekerjaanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusPekerjaan(int $id): void
    {
        Pekerjaan::destroy($id);
    }

    public function render()
    {
        $pekerjaans = Pekerjaan::query()->pencarian($this->cari)->paginate();

        return view('livewire.pekerjaan.pekerjaan-table', compact('pekerjaans'));
    }
}
