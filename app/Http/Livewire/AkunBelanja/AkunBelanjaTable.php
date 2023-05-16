<?php

namespace App\Http\Livewire\AkunBelanja;

use App\Models\AkunBelanja;
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class AkunBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusAkun(int $id): void
    {
        AkunBelanja::destroy($id);

        $this->notification()->success(
            'BERHASIL',
            'Data akun belanja terhapus.'
        );
    }

    public function pilihIdAkunBelanjaEvent(int $id)
    {
        $this->emit('pilihIdAkunBelanjaEvent', $id);
        $this->emit('rekeningGantiTabEvent', 'kelompok');
    }

    public function render()
    {
        $akuns = AkunBelanja::query()
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.akun-belanja.akun-belanja-table', compact('akuns'));
    }
}
