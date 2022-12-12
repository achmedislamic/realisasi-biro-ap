<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\Pencarian;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PenggunaTable extends Component
{
    use Pencarian, WithPagination;

    //membandingkan id yang disimpan dengan id yang di klik. jika iya, maka data bisa dihapus
    public string|int $konfirmasi;

    protected $queryString = ['cari' => ['except' => '']];

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
            ->paginate();

        return view('livewire.pengguna-table', compact('users'));
    }
}
