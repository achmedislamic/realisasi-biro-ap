<?php

namespace App\Http\Livewire\SubOpd;

use App\Models\Opd;
use App\Models\SubOpd;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubOpdTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idOpd = 0;
    public $idBidangUrusan = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
    'pilihIdOpdEvent' => 'pilihIdOpd'
    ];

    public function pilihIdOpd($idOpd, $idBidangUrusan)
    {
        $this->idOpd = $idOpd;
        $this->idBidangUrusan = $idBidangUrusan;
    }

    public function hapusSubOpd(int $id): void
    {
        SubOpd::destroy($id);
    }

    public function render()
    {
        $subOpds = SubOpd::query()
            ->whereOpdId($this->idOpd)
            ->pencarian($this->cari)
            ->paginate();

        $opd = Opd::query()
            ->with('bidangUrusans')
            ->whereHas('bidangUrusans')
            ->whereBidangUrusanId($this->idBidangUrusan)
            ->find($this->idOpd);

        return view('livewire.sub-opd.sub-opd-table', compact('subOpds', 'opd'));
    }
}
