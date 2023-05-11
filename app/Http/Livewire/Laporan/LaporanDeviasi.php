<?php

namespace App\Http\Livewire\Laporan;

use App\Exports\LaporanDeviasiExport;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LaporanDeviasi extends Component
{
    public $bulan;

    public function cetak()
    {
        return Excel::download(new LaporanDeviasiExport($this->bulan), 'laporan-deviasi.xlsx');
    }

    public function render(): View
    {
        return view('livewire.laporan.laporan-deviasi', [
            'months' => \App\Helpers\TanggalHelper::daftarBulan(),
        ]);
    }
}
