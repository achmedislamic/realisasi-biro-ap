<?php

namespace App\Http\Livewire\Program;

use App\Models\Program;
use App\Traits\Pencarian;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class ProgramTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $menu = '';

    public $bidangId;

    public $subOpdId;

    protected $listeners = ['opdUpdated' => 'passOpdId', 'subOpdUpdated' => 'passSubOpdId'];

    public function pilihIdProgramEvent(int $id, string $menu = '', int|string $bidangId = null, int|string $subOpdId = null): void
    {
        $this->emit('pilihIdProgramEvent', $id, $menu, $bidangId, $subOpdId);
        $this->emit('proKegGantiTabEvent', 'kegiatan');
    }

    public function passOpdId($bidangId): void
    {
        $this->bidangId = $bidangId;
        $this->reset('subOpdId');
    }

    public function passSubOpdId($subOpdId): void
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

    public function render(): View
    {
        Gate::authorize('realisasi-menu', [$this->bidangId, $this->subOpdId]);
        $programs = Program::query()
            ->when($this->menu == 'realisasi', function ($query) {
                // tampilkan daftar program berdasarkan sub_opd_id
                $query->join('kegiatans AS k', 'k.program_id', '=', 'programs.id')
                    ->join('sub_kegiatans AS sk', 'sk.kegiatan_id', '=', 'k.id')
                    ->join('objek_realisasis AS ore', 'ore.sub_kegiatan_id', '=', 'sk.id')
                    ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
                    ->join('sub_opds AS so', 'buso.sub_opd_id', '=', 'so.id')
                    ->join('opds AS o', 'so.opd_id', '=', 'o.id')
                    ->when(filled($this->bidangId), function ($query) {
                        $query->where('o.id', $this->bidangId);
                    })->when(filled($this->subOpdId), function ($query) {
                        $query->where('so.id', $this->subOpdId);
                    })
                    ->select('programs.nama', 'programs.id', 'programs.kode')
                    ->groupByRaw('programs.id, programs.kode, programs.nama')
                    ->orderBy('programs.kode')
                    ->orderBy('programs.nama');
            })
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.program.program-table', compact('programs'));
    }
}
