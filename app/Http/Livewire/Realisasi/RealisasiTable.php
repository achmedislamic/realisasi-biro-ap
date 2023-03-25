<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\Opd;
use App\Models\Realisasi;
use App\Models\SubOpd;
use App\Models\TahapanApbd;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RealisasiTable extends Component
{
    use WithPagination;
    use Actions;

    public $tahapanApbds;
    public $cari;
    public $dariTanggal;
    public $sampaiTanggal;
    public $idTahapanApbd;

    public $pods;
    public $subOpds;
    public $opdPilihan = null;
    public $subOpdPilihan = null;

    public function mount()
    {
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
        $this->dariTanggal = date('Y-m-d');
        $this->sampaiTanggal = date('Y-m-d');


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

    public function hapusRealisasiBelanja(int $id): void
    {
        try {
            Realisasi::destroy($id);
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

    public function render()
    {
        $userIsOPD = Auth::user()->role;
        $subOpdPilihan = $this->subOpdPilihan;

        $realisasiApbds = Realisasi::query()
            ->where('tahapan_apbd_id', Cookie::get('TAID'))
            ->whereBetween('tanggal', [$this->dariTanggal, $this->sampaiTanggal])
            ->when($userIsOPD->role_name == 'opd', function (Builder $query) use ($userIsOPD) {
                $query->where('sub_opd_id', $userIsOPD->sub_opd_id);
            })
            ->when(!$subOpdPilihan == "", function (Builder $query) use ($subOpdPilihan) {
                $query->where('sub_opd_id', $subOpdPilihan);
            })
            ->paginate();

        return view('livewire.realisasi.realisasi-table', compact('realisasiApbds'));
    }
}
