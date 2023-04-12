<?php

namespace App\Exports;

use App\Models\BidangUrusan;
use App\Models\Opd;
use App\Models\SubOpd;
use App\Models\Urusan;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanFormAExport implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting, WithColumnWidths
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

    public function columnWidths(): array
    {
        return [
            'B' => 45,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'C1:C15' => NumberFormat::FORMAT_GENERAL,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E1:E15' => NumberFormat::FORMAT_GENERAL,
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H1:H15' => NumberFormat::FORMAT_GENERAL,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'K1:K15' => NumberFormat::FORMAT_GENERAL,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N1:N15' => NumberFormat::FORMAT_GENERAL,

            'L' => NumberFormat::FORMAT_PERCENTAGE_00,
            'L1:L15' => NumberFormat::FORMAT_GENERAL,
            'F' => NumberFormat::FORMAT_PERCENTAGE_00,
            'F1:F15' => NumberFormat::FORMAT_GENERAL,
            'I' => NumberFormat::FORMAT_PERCENTAGE_00,
            'I1:I15' => NumberFormat::FORMAT_GENERAL,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A3:A5')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A11:N15')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('C')->getAlignment()->setHorizontal('right')->setVertical('center');
        $sheet->getStyle('C1:C15')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A11:N15')->getFont()->setBold(true);
    }

    public function view(): View
    {
        $bulan = CarbonImmutable::createFromFormat('Y-m-d', cache('tahapanApbd')->tahun . '-12-31');
        $bulanLaluMulai = $bulan->startOfMonth()->subMonth(1)->toDateString();
        $bulanLaluSelesai = $bulan->startOfMonth()->subMonth(1)->endOfMonth()->toDateString();

        $bulanIniMulai = $bulan->startOfMonth()->toDateString();
        $bulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $sdBulanIniMulai = $bulan->startOfYear()->toDateString();
        $sdBulanIniSelesai = $bulan->toDateString();

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

            ->selectRaw("p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, SUM( or.anggaran) AS anggaran, SUM(IF(r.tanggal BETWEEN '{$bulanLaluMulai}' AND '{$bulanLaluSelesai}', r.jumlah, 0)) AS realisasi_bulan_lalu, SUM(IF(r.tanggal BETWEEN '{$bulanIniMulai}' AND '{$bulanIniSelesai}', r.jumlah, 0)) AS realisasi_bulan_ini, SUM(IF(r.tanggal BETWEEN '{$sdBulanIniMulai}' AND '{$sdBulanIniSelesai}', r.jumlah, 0)) AS realisasi_sd_bulan_ini")
            ->where('or.tahapan_apbd_id', cache('tahapanApbd')->id)
            ->where('or.anggaran', '!=', 0)
            ->where('u.id', $this->urusanId)
            ->when(filled($this->bidangUrusanId), function ($query) {
                $query->where('bu.id', $this->bidangUrusanId);
            })
            ->where('o.id', $this->opdId)
            ->when(filled($this->subOpdId), function ($query) {
                $query->where('so.id', $this->subOpdId);
            })
            ->groupByRaw('p.nama, k.nama, sk.nama')
            ->orderByRaw('p.nama, k.nama, sk.nama')
            // ->dd()
            ->get();

        $namaUrusan = Urusan::find($this->urusanId)->nama;
        $namaBidangUrusan = filled($this->bidangUrusanId) ? BidangUrusan::find($this->bidangUrusanId)->nama : null;
        $namaOpd = Opd::find($this->opdId)->nama;
        $namaSubOpd = filled($this->subOpdId) ? SubOpd::find($this->subOpdId)->nama : null;
        return view('exports.laporan-form-a-export', compact('opds', 'namaUrusan', 'namaBidangUrusan', 'namaOpd', 'namaSubOpd'));
    }
}
