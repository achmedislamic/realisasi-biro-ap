<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormEExport;
use App\Models\{Opd, SubOpd};
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use WireUi\Traits\Actions;

class LaporanFormE extends Component
{
    use Actions;

    public $triwulan;

    public $opds;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    public function mount()
    {
        $this->opds = Opd::orderBy('nama')->get();
        $this->subOpds = collect();
    }

    public function updatedOpdDipilih($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->reset('subOpdDipilih');
    }

    public function cetak()
    {
        $this->validate([
            'triwulan' => 'required|numeric',
            'opdDipilih' => 'required|numeric',
            'subOpdDipilih' => 'nullable|numeric',
        ]);

        return Excel::download(new LaporanFormEExport($this->triwulan, $this->opdDipilih, $this->subOpdDipilih), 'laporan-form-e.xlsx');
    }

    public function render()
    {
        return view('livewire.laporan.laporan-form-e');
    }
}
