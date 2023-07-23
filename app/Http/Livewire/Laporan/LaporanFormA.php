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

        $this->subOpds = SubOpd::where('opd_id', 1)
            ->orderBy('kode')
            ->get();

        if (auth()->user()->isSubOpd()) {
            $this->subOpdDipilih = auth()->user()->role->imageable_id;
            $this->opdDipilih = SubOpd::select('opd_id')->find($this->subOpdDipilih)->opd_id;
        }
        $this->bidangUrusans = collect();
    }

    public function updatedUrusanDipilih($value)
    {
        $this->bidangUrusans = BidangUrusan::where('urusan_id', $value)->get();

        $this->reset('bidangUrusanDipilih');
    }

    public function rules()
    {
        return [
            'urusanDipilih' => 'required|numeric',
            'bidangUrusanDipilih' => 'nullable|string',
            'bulan' => 'required|string|max:15',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ];
    }

    public function cetak(): BinaryFileResponse
    {
        $this->validate();

        return Excel::download(new LaporanFormAExport($this->urusanDipilih, $this->bidangUrusanDipilih, $this->bulan, $this->opdDipilih, $this->subOpdDipilih), 'laporan-form-a.xlsx');
    }

    public function render()
    {
        return view('livewire.laporan.laporan-form-a', [
            'urusans' => Urusan::orderBy('kode')->get(),
            'bulans' => \App\Helpers\TanggalHelper::daftarBulan(),
        ]);
    }
}
