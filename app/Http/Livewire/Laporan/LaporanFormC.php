<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormAExport;
use App\Models\{BidangUrusan, Opd, SubOpd, Urusan};
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use WireUi\Traits\Actions;

final class LaporanFormC extends Component
{
    use Actions;

    public $urusanDipilih = null;

    public $bidangUrusanDipilih = null;

    public $triwulan;

    public $opds;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    private $anggarans;

    public $bidangUrusans;

    public function mount()
    {
        $this->anggarans = collect();
        $this->opds = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
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
            'urusanDipilih' => 'required|numeric',
            'bidangUrusanDipilih' => 'nullable|numeric',
            'triwulan' => 'required|string|max:15',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ];
    }

    public function cetak()
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
