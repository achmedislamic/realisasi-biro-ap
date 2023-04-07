<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CetakLaporanDeviasiController extends Controller
{
    public function __invoke()
    {
        $spreadsheet = IOFactory::load(storage_path('template\laporan-deviasi.xlsx'));

        $worksheet = $spreadsheet->getActiveSheet();

        $queryResult = DB::select('SELECT 1 AS nomor, opds.nama AS nama_opd, SUM(obr.anggaran) AS pagu, SUM(r.jumlah) AS realisasi, 1 AS deviasi, (SUM(r.jumlah) / SUM(obr.anggaran) * 100) AS persen_realisasi_keuangan, 1 AS persen_realisasi_fisik, 1 AS persen_deviasi_keuangan, 1 AS persen_deviasi_fisik
        FROM opds
        INNER JOIN sub_opds AS so ON opds.id = so.opd_id
        INNER JOIN objek_realisasis AS obr ON obr.sub_opd_id = so.id
        LEFT JOIN realisasis AS r ON obr.id = r.objek_realisasi_id
        GROUP BY opds.id
        ORDER BY opds.nama ASC');

        $datas = [];
        foreach($queryResult as $row){
            $array = (array) $row;
            $datas[] = collect($array)->values()->all();
        }

        $worksheet->fromArray(
            $datas, NULL, 'A5'
        );

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(storage_path('template/hasil-laporan-deviasi.xlsx'));

        return response()->download(storage_path('template/hasil-laporan-deviasi.xlsx'))->deleteFileAfterSend();
    }
}
