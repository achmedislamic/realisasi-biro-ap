<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormAExport;
use App\Models\{BidangUrusan, Kegiatan, ObjekRealisasi, Opd, Program, SubKegiatan, SubOpd, Urusan};
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use WireUi\Traits\Actions;

final class LaporanSemester extends Component
{
    use Actions;

    public $urusanDipilih = null;

    public $bidangUrusanDipilih = null;

    public $semester;

    public $opds;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    private $anggarans;

    public $bidangUrusans;

    public function mount(): void
    {
        $this->anggarans = collect();
        $this->opds = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
        if (auth()->user()->isOpd()) {
            $this->subOpds = SubOpd::where('opd_id', auth()->user()->role->imageable_id)->orderBy('nama')->get();
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdDipilih = auth()->user()->role->imageable_id;
        }
        $this->bidangUrusans = collect();
    }

    public function updatedUrusanDipilih($value): void
    {
        $this->bidangUrusans = BidangUrusan::where('urusan_id', $value)->get();

        $this->reset('bidangUrusanDipilih');
    }

    public function updatedOpdDipilih($opd): void
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->reset('subOpdDipilih');
    }

    public function rules(): array
    {
        return [
            'urusanDipilih' => 'required|numeric',
            'bidangUrusanDipilih' => 'nullable|string',
            'semester' => 'required|string|max:15',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ];
    }

    public function cetak(): BinaryFileResponse
    {
        $this->validate();

        return Excel::download(new LaporanFormAExport($this->urusanDipilih, $this->bidangUrusanDipilih, $this->semester, $this->opdDipilih, $this->subOpdDipilih, jenisLaporan: 'semester'), 'laporan-semester.xlsx');
    }

    public function render(): View
    {
        return view('livewire.laporan.laporan-semester', [
            'urusans' => Urusan::orderBy('kode')->get(),
            'bulans' => \App\Helpers\TanggalHelper::daftarBulan(),
        ]);
    }
}
