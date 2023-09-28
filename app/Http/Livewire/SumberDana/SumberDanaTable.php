<?php

namespace App\Http\Livewire\SumberDana;

use App\Models\SumberDana;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SumberDanaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusKategori(int $id): void
    {
        SumberDana::destroy($id);
    }

    public function render()
    {
        return view('livewire.sumber-dana.sumber-dana-table', [
            'sumberDanas' => SumberDana::query()
                ->pencarian($this->cari)
                ->paginate()
        ]);
    }
}
