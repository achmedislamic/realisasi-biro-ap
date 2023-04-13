<?php

namespace App\Http\Livewire;

use App\Exports\LaporanDeviasiExport;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CetakLaporanDeviasi extends Component
{
    public $bulan;

    public function cetak()
    {
        return Excel::download(new LaporanDeviasiExport($this->bulan), 'laporan.xlsx');
    }

    public function render(): View
    {
        return view('livewire.cetak-laporan-deviasi', [
            'months' => \App\Helpers\TanggalHelper::daftarBulan(),
        ]);
    }
}
