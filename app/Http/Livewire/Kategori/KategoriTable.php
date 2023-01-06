<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class KategoriTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusKategori(int $id): void
    {
        Kategori::destroy($id);
    }


    public function render()
    {
        $kategoris = Kategori::query()->pencarian($this->cari)->paginate();

        return view('livewire.kategori.kategori-table', compact("kategoris"));
    }
}
