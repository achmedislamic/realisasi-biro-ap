<?php

namespace App\Http\Livewire\RekeningBelanja;

use App\Models\RekeningBelanja;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RekeningBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapuRekeningBelanja(int $id): void
    {
        RekeningBelanja::destroy($id);
    }

    public function render()
    {
        $rekeningBelanjas = RekeningBelanja::query()->pencarian($this->cari)->paginate();

        return view('livewire.rekening-belanja.rekening-belanja-table', compact('rekeningBelanjas'));
    }
}
