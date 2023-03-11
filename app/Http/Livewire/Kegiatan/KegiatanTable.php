<?php

namespace App\Http\Livewire\Kegiatan;

use App\Models\Kegiatan;
use App\Models\Program;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class KegiatanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $idProgram = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdProgramEvent' => 'pilihIdProgram'
    ];

    public function pilihIdKegiatanEvent(int $id)
    {
        $this->emit('pilihIdKegiatanEvent', $id);
        $this->emit('proKegGantiTabEvent', 'sub_kegiatan');
    }

    public function pilihIdProgram(int $idProgram)
    {
        $this->idProgram = $idProgram;
    }

    public function hapusKegiatan(int $id): void
    {
        Kegiatan::destroy($id);
    }

    public function render()
    {
        $kegiatans = Kegiatan::query()
        ->whereProgramId($this->idProgram)
        ->pencarian($this->cari)
        ->paginate();

        $program = Program::find($this->idProgram);

        return view('livewire.kegiatan.kegiatan-table', compact(['kegiatans', 'program']));
    }
}
