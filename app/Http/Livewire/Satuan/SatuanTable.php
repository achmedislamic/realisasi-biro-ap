<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use App\Traits\Pencarian;
use Illuminate\View\View;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class SatuanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $querystring = ['cari' => ['expept' => '']];

    public function hapusSatuan(int $id): void
    {
        Satuan::destroy($id);
    }

    public function render(): View
    {
        $satuans = Satuan::query()->pencarian($this->cari)->paginate();

        return view('livewire.satuan.satuan-table', compact('satuans'));
    }
}
