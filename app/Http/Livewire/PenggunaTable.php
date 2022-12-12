<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;

class PenggunaTable extends Component
{
    use Pencarian, WithPagination;

    public string $cari = '';

    protected $queryString = ['cari' => ['except' => '']];

    public function render()
    {
        $users = User::query()
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.pengguna-table', compact('users'));
    }
}
