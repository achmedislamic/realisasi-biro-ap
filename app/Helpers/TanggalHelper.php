<?php

namespace App\Helpers;

use Carbon\Carbon;

class TanggalHelper
{
    public static function daftarBulan(): array
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

		return $results;
    }
}
