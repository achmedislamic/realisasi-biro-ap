<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\{Pencarian, WithSorting};
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\{Component, WithPagination};

class PenggunaTable extends Component
{
    use Pencarian, WithPagination, WithSorting;

    //membandingkan id yang disimpan dengan id yang di klik. jika iya, maka data bisa dihapus
    public string|int $konfirmasi;

    protected $queryString = ['cari' => ['except' => ''], 'sortAsc' => ['except' => 'true'],
        'sortField'];

    public function konfirmasiHapus($id): void
    {
        $this->konfirmasi = $id;
    }

    public function destroy($id): void
    {
        User::destroy($id);
    }

    public function render(): View
    {
        $users = User::query()
            ->when(auth()->user()->isOpd(), function (Builder $query) {
                $query->whereRelation('role', 'imageable_id', auth()->user()->role->imageable_id);
            })
            ->pencarian($this->cari)
            ->whenSort($this->sortField, $this->sort)
            ->paginate();

        return view('livewire.pengguna-table', compact('users'));
    }
}
