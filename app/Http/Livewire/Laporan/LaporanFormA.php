<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormAExport;
use App\Models\{BidangUrusan, SubOpd, Urusan};
use Livewire\{Component, WithPagination};
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use WireUi\Traits\Actions;

final class LaporanFormA extends Component
{
    use Actions;
    use WithPagination;

    public $urusanDipilih = null;

    public $bidangUrusanDipilih = null;

    public $bulan;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    private $anggarans;

    public $bidangUrusans;

    public function mount()
    {
        $this->anggarans = collect();
        $this->subOpds = collect();
        if (auth()->user()->isOpd()) {
            $this->subOpds = SubOpd::where('opd_id', auth()->user()->role->imageable_id)->orderBy('nama')->get();
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdDipilih = auth()->user()->role->imageable_id;
        }
        $this->bidangUrusans = collect();
    }

    public function updatedUrusanDipilih($value)
    {
        $this->bidangUrusans = BidangUrusan::where('urusan_id', $value)->get();

        $this->reset('bidangUrusanDipilih');
    }

    public function updatedOpdDipilih($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->reset('subOpdDipilih');
    }

    public function rules()
    {
        $rules = [
            'urusanDipilih' => 'required|integer',
            'bidangUrusanDipilih' => 'nullable|integer',
            'bulan' => 'required|string|max:15',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ];

        if(auth()->user()->isOpd()){
            unset($rules['opdDipilih']);
        }

        return $rules;
    }

    public function cetak(): BinaryFileResponse
    {
        $this->validate();

        return Excel::download(new LaporanFormAExport($this->urusanDipilih, $this->bidangUrusanDipilih, $this->bulan, $this->opdDipilih, $this->subOpdDipilih), 'laporan-form-a.xlsx');
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
        return view('livewire.laporan.laporan-form-a', [
            'urusans' => Urusan::orderBy('kode')->get(),
            'bulans' => \App\Helpers\TanggalHelper::daftarBulan(),
        ]);
    }
}
