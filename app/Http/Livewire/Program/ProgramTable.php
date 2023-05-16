<?php

namespace App\Http\Livewire\Program;

use App\Models\Program;
use App\Traits\Pencarian;
use Illuminate\Support\Facades\Gate;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class ProgramTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $menu = '';

    public $opdId;

    public $subOpdId;

    protected $listeners = ['opdUpdated' => 'passOpdId', 'subOpdUpdated' => 'passSubOpdId'];

    public function pilihIdProgramEvent(int $id, string $menu = '', int|string $opdId = null, int|string $subOpdId = null)
    {
        $this->emit('pilihIdProgramEvent', $id, $menu, $opdId, $subOpdId);
        $this->emit('proKegGantiTabEvent', 'kegiatan');
    }

    public function passOpdId($opdId)
    {
        $this->opdId = $opdId;
        $this->reset('subOpdId');
    }

    public function passSubOpdId($subOpdId)
    {
        $this->subOpdId = $subOpdId;
    }

    public function hapusProgram(int $id): void
    {
        Program::destroy($id);
        $this->notification()->success(
            'BERHASIL',
            'Data program terhapus.'
        );
    }

    public function render()
    {
        Gate::authorize('realisasi-menu', [$this->opdId, $this->subOpdId]);
        $programs = Program::query()
            ->when($this->menu == 'realisasi', function ($query) {
                // tampilkan daftar program berdasarkan sub_opd_id
                $query->join('kegiatans AS k', 'k.program_id', '=', 'programs.id')
                    ->join('sub_kegiatans AS sk', 'sk.kegiatan_id', '=', 'k.id')
                    ->join('objek_realisasis AS ore', 'ore.sub_kegiatan_id', '=', 'sk.id')
                    ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
                    ->join('sub_opds AS so', 'buso.sub_opd_id', '=', 'so.id')
                    ->join('opds AS o', 'so.opd_id', '=', 'o.id')
                    ->when(filled($this->opdId), function ($query) {
                        $query->where('o.id', $this->opdId);
                    })->when(filled($this->subOpdId), function ($query) {
                        $query->where('so.id', $this->subOpdId);
                    })
                    ->select('programs.nama', 'programs.id', 'programs.kode')
                    ->groupBy('programs.id')
                    ->orderBy('programs.kode')
                    ->orderBy('programs.nama');
            })
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.program.program-table', compact('programs'));
    }
}
