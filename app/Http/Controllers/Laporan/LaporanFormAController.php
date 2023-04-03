<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\Program;
use App\Models\Urusan;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class LaporanFormAController extends Controller
{
    public function index()
    {
        return view('laporan.laporan-form-a');
    }

    public function export()
    {
        $rows = [];
        // $rows[] = [
        //     'No.',
        //     'Program/Kegiatan/Sub Kegiatan',
        //     'Jumlah Anggaran (Rp)',
        //     'Bobot (%)',
        //     'Realisasi Pelaksanaan Anggaran',
        //     '',
        //     '',
        //     '',
        //     '',
        //     '',
        //     '',
        //     '',
        //     '',
        //     'Sisa Anggaran (Rp)',
        // ];

        // $rows[] = [
        //     '',
        //     '',
        //     '',
        //     '',
        //     'Bulan Lalu',
        //     '',
        //     '',
        //     'Bulan Ini',
        //     '',
        //     '',
        //     's.d Bulan Ini',
        //     '',
        //     '',
        //     '',
        // ];

        // $rows[] = [
        //     '',
        //     '',
        //     '',
        //     '',
        //     'Keuangan',
        //     '',
        //     'Fisik',
        //     'Keuangan',
        //     '',
        //     'Fisik',
        //     'Keuangan',
        //     '',
        //     'Fisik',
        //     '',
        // ];

        // $rows[] = [
        //     '',
        //     '',
        //     '',
        //     '',
        //     'Rp',
        //     '%',
        //     '%',
        //     'Rp',
        //     '%',
        //     '%',
        //     'Rp',
        //     '%',
        //     '%',
        //     '',
        // ];

        // $rows[] = [
        //     '1',
        //     '2',
        //     '3',
        //     '4',
        //     '5',
        //     '6',
        //     '7',
        //     '8',
        //     '9',
        //     '10',
        //     '11',
        //     '12',
        //     '13',
        //     '14',
        // ];

        // Program::with('objekRealisasis')->chunk(250, function ($programs) use (&$rows) {
        //     $no = 1;
        //     foreach ($programs as $program) {
        //         $rows[] = [
        //             $no,
        //             $program->nama,
        //             $program->objekRealisasis->sum('anggaran'),
        //             '',
        //             '5',
        //             '6',
        //             '7',
        //             '8',
        //             '9',
        //             '10',
        //             '11',
        //             '12',
        //             '13',
        //             '14',
        //         ];

        //         $no++;
        //     }
        // });

        $program = Program::has('realisasis')->get();
        return $program;
        SimpleExcelWriter::streamDownload('programs.xlsx')
            ->noHeaderRow()
            ->addRows($rows);
    }
}
