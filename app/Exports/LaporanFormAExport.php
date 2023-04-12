<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanFormAExport implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    public function __construct(
        public int $urusanId,
        public ?int $bidangUrusanId = null,
        public string $bulan,
        public int $opdId,
        public ?int $subOpdId = null
    ) {
        //
    }

    public function columnFormats(): array
    {
        return [
            'C16:C10000' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E16:E10000' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H16:H10000' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'K16:K10000' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N16:N10000' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'L16:L10000' => NumberFormat::FORMAT_PERCENTAGE,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A3:A5')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A11:N15')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A11:N15')->getFont()->setBold(true);
    }

    public function view(): View
    {
        $bulan = Carbon::createFromFormat('Y-m-d', '2024-06-06');
        $bulanLaluMulai = $bulan->subMonth(1)->startOfMonth()->toDateString();
        $bulanLaluSelesai = $bulan->subMonth(1)->endOfMonth()->toDateString();

        $bulanIniMulai = $bulan->startOfMonth()->toDateString();
        $bulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $sdBulanIniMulai = $bulan->startOfYear()->toDateString();
        $sdBulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $opds = DB::table('objek_realisasis AS or')
            ->join('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')
            ->join('sub_kegiatans AS sk', 'sk.id', '=', 'or.sub_kegiatan_id')
            ->join('kegiatans AS k', 'sk.kegiatan_id', '=', 'k.id')
            ->join('programs AS p', 'k.program_id', '=', 'p.id')

            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'or.bidang_urusan_sub_opd_id')
            ->join('bidang_urusans AS bu', 'bu.id', '=', 'buso.bidang_urusan_id')
            ->join('urusans AS u', 'u.id', '=', 'bu.urusan_id')

            ->join('sub_opds AS so', 'so.id', '=', 'buso.sub_opd_id')
            ->join('opds AS o', 'o.id', '=', 'so.opd_id')

            ->selectRaw("u.nama AS nama_urusan, bu.nama AS nama_bidang_urusan, o.nama AS nama_opd, so.nama AS nama_sub_opd, p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, SUM( or.anggaran) AS anggaran, SUM(IF(r.tanggal BETWEEN '{$bulanLaluMulai}' AND '{$bulanLaluSelesai}', r.jumlah, 0)) AS realisasi_bulan_lalu, SUM(IF(r.tanggal BETWEEN '{$bulanIniMulai}' AND '{$bulanIniSelesai}', r.jumlah, 0)) AS realisasi_bulan_ini, SUM(IF(r.tanggal BETWEEN '{$sdBulanIniMulai}' AND '{$sdBulanIniSelesai}', r.jumlah, 0)) AS realisasi_sd_bulan_ini")
            ->where('or.tahapan_apbd_id', cache('tahapanApbd')->id)
            ->groupByRaw('u.nama, bu.nama, o.nama, so.nama, p.nama, k.nama, sk.nama')
            ->orderByRaw('u.nama, bu.nama, o.nama, so.nama, p.nama, k.nama, sk.nama')
            // ->dd()
            ->get();

        return view('exports.laporan-form-a-export', compact('opds'));
    }
}
