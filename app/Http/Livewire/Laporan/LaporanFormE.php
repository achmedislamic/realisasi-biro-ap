<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormEExport;
use App\Models\SubOpd;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use WireUi\Traits\Actions;

final class LaporanFormE extends Component
{
    use Actions;

    public $triwulan;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    public function mount()
    {
        $this->subOpds = collect();
        if (auth()->user()->isOpd()) {
            $this->subOpds = SubOpd::where('opd_id', auth()->user()->role->imageable_id)->orderBy('nama')->get();
        }

        if (auth()->user()->isSubOpd()) {
            $this->subOpdDipilih = auth()->user()->role->imageable_id;
        }
    }

    public function updatedOpdDipilih($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->reset('subOpdDipilih');
    }

    public function cetak(): BinaryFileResponse
    {
        $this->validate([
            'triwulan' => 'required|numeric',
            'opdDipilih' => 'required|integer',
            'subOpdDipilih' => 'nullable|integer',
        ]);

        return Excel::download(new LaporanFormEExport($this->triwulan, $this->opdDipilih, $this->subOpdDipilih), 'laporan-form-e.xlsx');
    }

    public function render(): View
    {
        return view('livewire.laporan.laporan-form-e');
    }
}
