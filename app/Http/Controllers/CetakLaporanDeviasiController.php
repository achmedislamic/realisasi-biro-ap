<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CetakLaporanDeviasiController extends Controller
{
    public function __invoke()
    {
        $spreadsheet = IOFactory::load(storage_path('template\laporan-deviasi.xlsx'));

        $data = [
            [1, 'Bapenda', 10000, 1000, 200, '11.19', '11.19', '-1.17', '-0.36']
        ];

        IOFactory::load(storage_path('template\laporan-deviasi.xlsx'))->getActiveSheet()
            ->fromArray(
                $data, NULL, 'A5'
            );

        IOFactory::createWriter($spreadsheet, 'Xlsx')->save(storage_path('template/hasil-laporan-deviasi.xlsx'));

        return response()->download(storage_path('template/hasil-laporan-deviasi.xlsx'))->deleteFileAfterSend();
    }
}
