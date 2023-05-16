<?php

namespace App\Http\Livewire\Urusan;

use App\Models\Urusan;
use App\Traits\Pencarian;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class UrusanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function hapusUrusan(int $id): void
    {
        Urusan::destroy($id);
        $this->notification()->success(
            'BERHASIL',
            'Data urusan terhapus.'
        );
    }

    public function pilihIdUrusanEvent(int $id): void
    {
        $this->emit('pilihIdUrusanEvent', $id);
        $this->emit('gantiTab', 'bidang_urusan');
    }

    public function render(): View
    {
        $urusans = Urusan::query()->pencarian($this->cari)->paginate();

        return view('livewire.urusan.urusan-table', compact('urusans'));
    }
}
