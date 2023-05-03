<?php

namespace App\Http\Livewire\Kegiatan;

use App\Models\{Kegiatan, Program};
use App\Traits\Pencarian;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class KegiatanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public $programId = 0;

    public $menu = '';

    public $opdId = null;

    public $subOpdId = null;

    protected $listeners = [
        'pilihIdProgramEvent' => 'pilihIdProgram', 'opdUpdated',
    ];

    public function opdUpdated()
    {
        $this->reset();
    }

    public function pilihIdKegiatanEvent(int $id, string $menu = '', int|string $opdId = null, int|string $subOpdId = '')
    {

        $this->emit('pilihIdKegiatanEvent', $id, $menu, $opdId, $subOpdId);
        $this->emit('proKegGantiTabEvent', 'sub_kegiatan');
    }

    public function pilihIdProgram(int $programId, string $menu = '', int|string $opdId = null, int|string $subOpdId = null)
    {
        $this->menu = $menu;
        $this->opdId = $opdId;
        $this->subOpdId = $subOpdId;
        $this->programId = $programId;

        $this->emit('gantiTab', 'kegiatan');
    }

    public function hapusKegiatan(int $id): void
    {
        try {
            Kegiatan::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data kegiatan terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data kegiatan tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        Gate::authorize('realisasi-menu', [$this->opdId, $this->subOpdId]);
        $kegiatans = Kegiatan::query()
            ->when(filled($this->menu), function (Builder $query) {
                $query->join('sub_kegiatans AS sk', 'sk.kegiatan_id', '=', 'kegiatans.id')
                    ->join('objek_realisasis AS ore', 'ore.sub_kegiatan_id', '=', 'sk.id')
                    ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'ore.bidang_urusan_sub_opd_id')
                    ->join('sub_opds AS so', 'buso.sub_opd_id', '=', 'so.id')
                    ->join('opds AS o', 'so.opd_id', '=', 'o.id')
                    ->when(filled($this->opdId), function ($query) {
                        $query->where('o.id', $this->opdId);
                    })->when(filled($this->subOpdId), function ($query) {
                        $query->where('so.id', $this->subOpdId);
                    })
                    ->groupBy('kegiatans.id')
                    ->orderBy('kegiatans.kode')
                    ->orderBy('kegiatans.nama');
            })
            ->where('program_id', $this->programId)
            ->select('kegiatans.nama', 'kegiatans.id', 'kegiatans.kode')
            ->pencarian($this->cari)
            ->paginate();

        $program = Program::find($this->programId);

        return view('livewire.kegiatan.kegiatan-table', compact(['kegiatans', 'program']));
    }
}
