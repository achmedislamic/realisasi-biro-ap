<?php

namespace App\Http\Livewire\Program;

use App\Models\Program;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ProgramTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    protected $queryString = ['cari' => ['except' => '']];

    public function pilihIdProgramEvent(int $id)
    {
        $this->emit('pilihIdProgramEvent', $id);
        $this->emit('proKegGantiTabEvent', 'kegiatan');
    }

    public function hapusProgram(int $id): void
    {
        Program::destroy($id);
    }

    public function render()
    {
        $programs = Program::query()->pencarian($this->cari)->paginate();
        return view('livewire.program.program-table', compact("programs"));
    }
}
