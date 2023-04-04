<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\Pencarian;
use App\Traits\WithSorting;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

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
            ->pencarian($this->cari)
            ->whenSort($this->sortField, $this->sort)
            ->paginate();

        return view('livewire.pengguna-table', compact('users'));
    }
}
