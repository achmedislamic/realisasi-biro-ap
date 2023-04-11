<?php

namespace App\Http\Livewire\Program;

use App\Models\Program;
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
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
        try {
            Program::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data program terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data program tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $programs = Program::query()->pencarian($this->cari)->paginate();

        return view('livewire.program.program-table', compact('programs'));
    }
}
