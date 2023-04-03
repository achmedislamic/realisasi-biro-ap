<?php

namespace App\Http\Livewire\Laporan;

use App\Models\Kegiatan;
use App\Models\ObjekRealisasi;
use App\Models\Opd;
use App\Models\Program;
use App\Models\SubKegiatan;
use App\Models\SubOpd;
use App\Models\Urusan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use WireUi\Traits\Actions;

class LaporanFormA extends Component
{
    use Actions;
    use WithPagination;

    public $idUrusanPilihan = null;
    public $bulan = 1;

    public $pods;
    public $subOpds;
    public $idOpdPilihan = null;
    public $idSubOpdPilihan = null;

    private $anggarans;

    public function mount()
    {
        $this->anggarans = collect();
        $this->pods = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
    }

    public function updatedIdOpdPilihan($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->idSubOpdPilihan = null;
    }

    public function rules()
    {
        return [
            'idUrusanPilihan' => 'required',
            'bulan' => 'required',
            'idOpdPilihan' => 'required',
            'idSubOpdPilihan' => 'required',
        ];
    }

    public function fecthData()
    {
        // $this->validate();

        // $idPrograms = Program::get()->pluck('id');
        // dd($idPrograms);

        // $idKegiatans = Kegiatan::query()
        //     ->whereIn('program_id', $idPrograms)
        //     ->get()
        //     ->pluck('id');
        // dd($idKegiatans);

        // $idSubKegiatans = SubKegiatan::query()
        //            ->whereIn('kegiatan_id', $idKegiatans)
        //            ->get()
        //            ->pluck('id');
        // dd($idSubKegiatans);

        // $realisasis = ObjekRealisasi::get();
        // dd($realisasis);

        // $realisasis = ObjekRealisasi::whereHas('realisasi')->get();
        // $realisasis = ObjekRealisasi::groupBy('sub_kegiatan_id')
        //     ->select('sub_kegiatan_id', DB::raw('sum(anggaran) as anggaran'))
        //     ->take(5)
        //     ->get();

        // $realisasis = DB::table('objek_realisasis')
        //     ->leftJoin('sub_kegiatans', 'objek_realisasis.sub_kegiatan_id', '=', 'sub_kegiatans.id')
        //     ->leftJoin('kegiatans', 'sub_kegiatans.kegiatan_id', '=', 'kegiatans.id')
        //     ->leftJoin('programs', 'kegiatans.program_id', '=', 'programs.id')
        //     ->leftJoin('realisasis', 'realisasis.objek_realisasi_id', '=', 'objek_realisasis.id')
        //     ->select(
        //         'programs.kode as kode_program',
        //         'programs.nama as nama_program',
        //         'kegiatans.kode as kode_kegiatan',
        //         'kegiatans.nama as nama_kegiatan',
        //         'sub_kegiatans.kode as kode_sub_kegiatan',
        //         'sub_kegiatans.nama as nama_sub_kegiatan',
        //         'objek_realisasis.anggaran as anggaran',
        //         'realisasis.realisasi as realisasi',
        //     )
        //     ->get();

        // $realisasis = ObjekRealisasi::with(['subKegiatan.kegiatan.program', 'realisasi'])->get();

        // $this->anggarans = Program::with('objekRealisasis')->get();
        // $rows = [];

        // foreach ($this->anggarans->toArray() as $program) {
        //     $rows[] = $program;
        // }


        SimpleExcelWriter::streamDownload('your-export.xlsx')
             ->addRow([
                'first_name' => 'John',
                'last_name' => 'Doe',
            ])
            ->addRow([
                'first_name' => 'Jane',
                'last_name' => 'Doe',
            ])
            ->toBrowser();
    }

    public function render()
    {
        $urusans = Urusan::orderBy('kode')->get();

        return view('livewire.laporan.laporan-form-a', compact(['urusans']));
    }
}
