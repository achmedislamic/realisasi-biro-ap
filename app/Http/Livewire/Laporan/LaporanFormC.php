<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormAExport;
use App\Models\{BidangUrusan, Opd, SubOpd, Urusan};
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use WireUi\Traits\Actions;

final class LaporanFormC extends Component
{
    use Actions;

    public $urusanDipilih = null;

    public $bidangUrusanDipilih = null;

    public $triwulan;

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
        return [
            'urusanDipilih' => 'required|integer',
            'bidangUrusanDipilih' => 'nullable|integer',
            'triwulan' => 'required|string|max:15',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ];
    }

    public function cetak(): BinaryFileResponse
    {
        $this->validate();

        return Excel::download(new LaporanFormAExport($this->urusanDipilih, $this->bidangUrusanDipilih, $this->triwulan, $this->opdDipilih, $this->subOpdDipilih, 'c'), 'laporan-form-c.xlsx');
    }

    public function render()
    {
        return view('livewire.laporan.laporan-form-c', [
            'urusans' => Urusan::orderBy('kode')->get(),
        ]);
    }
}
