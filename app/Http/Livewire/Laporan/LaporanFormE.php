<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanFormAExport;
use App\Models\{Opd, SubOpd};
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use WireUi\Traits\Actions;

class LaporanFormE extends Component
{
    use Actions;

    public $periode;

    public $opds;

    public $subOpds;

    public $opdDipilih = null;

    public $subOpdDipilih = null;

    public function mount()
    {
        $this->opds = Opd::orderBy('kode')->get();
        $this->subOpds = collect();
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
            'periode' => 'required|string|max:15',
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
        return view('livewire.laporan.laporan-form-e');
    }
}
