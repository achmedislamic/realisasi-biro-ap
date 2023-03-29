<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Models\Opd;
use App\Models\ObjekRealisasi;
use App\Models\SubOpd;
use App\Models\TahapanApbd;
use App\Traits\Pencarian;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ObjekRealisasiTable extends Component
{
    use WithPagination;
    use Actions;
    use Pencarian;

    public $tahapanApbds;
    public $idTahapanApbd;

    public $pods;
    public $subOpds;
    public $opdPilihan = null;
    public $subOpdPilihan = null;

    protected $queryString = ['cari' => ['except' => '']];

    public function mount()
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();

        $this->pods = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
    }

    public function updatedOpdPilihan($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;
    }

    public function hapusObjekRealisasiBelanja(int $id): void
    {
        try {
            ObjekRealisasi::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data realisasi belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data realisasi belanja tidak dapat dihapus.'
            );
        }
    }

    public function pilihIdObjekRealisasiEvent(int $idObjekRealisasi)
    {
        $this->emit('pilihIdObjekRealisasiEvent', $idObjekRealisasi);
        $this->emit('gantiTab', 'realisasi');
    }

    public function render()
    {
        $userIsOPD = Auth::user()->role;
        $subOpdPilihan = $this->subOpdPilihan;

        $realisasiApbds = ObjekRealisasi::query()
            ->where('tahapan_apbd_id', Cookie::get('TAID'))
            ->when($userIsOPD->role_name == 'opd', function (Builder $query) use ($userIsOPD) {
                $query->where('sub_opd_id', $userIsOPD->sub_opd_id);
            })
            ->when(!$subOpdPilihan == "", function (Builder $query) use ($subOpdPilihan) {
                $query->where('sub_opd_id', $subOpdPilihan);
            })
            ->pencarian($this->cari)
            ->paginate();

        return view('livewire.objek-realisasi.objek-realisasi-table', compact('realisasiApbds'));
    }
}
