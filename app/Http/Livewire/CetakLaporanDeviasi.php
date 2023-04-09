<?php

namespace App\Http\Livewire;

use App\Exports\LaporanDeviasiExport;
use App\Models\Opd;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CetakLaporanDeviasi extends Component
{
    public $bulan;

    public function cetak()
    {
        return Excel::download(new LaporanDeviasiExport($this->bulan), 'laporan.xlsx');
    }
    public function render()
    {
        $date = \Carbon\Carbon::createFromDate(cache('tahapanApbd')->tahun, 1, 1);

        $results = [];
        for ($month = 1; $month <= 12; $month++) {
            $endDate = $date->endOfMonth();

            // nama bulan dalam bahasa indonesia
            $monthName = \Carbon\Carbon::create(cache('tahapanApbd')->tahun, $month, 1)->translatedFormat('F');

            $results[$monthName] = $endDate->toDateString();

            // balik lagi tanggalnya ke tanggal awal bulan kemudian pindah ke bulan berikutnya.
            // jika addMonth tanpa startOfMonth, maka akan skip 2 bulan
            $date->startOfMonth();
            $date->addMonth();
        }

        return view('livewire.cetak-laporan-deviasi', [
            'months' => $results
        ]);
    }
}
