<?php

namespace App\Http\Livewire\Urusan;

use App\Models\Urusan;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
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
    }

    public function pilihIdUrusanEvent(int $id)
    {
        $this->emit('pilihIdUrusanEvent', $id);
        $this->emit('gantiTab', 'bidang_urusan');
    }

    public function render()
    {
        $urusans = Urusan::query()->pencarian($this->cari)->paginate();
        return view('livewire.urusan.urusan-table', compact('urusans'));
    }
}
