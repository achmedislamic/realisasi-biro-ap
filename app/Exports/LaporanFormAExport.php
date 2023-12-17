<?php

namespace App\Exports;

use App\Models\{BidangUrusan, Opd, SubOpd, Urusan};
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\{FromView, ShouldAutoSize, WithColumnFormatting, WithColumnWidths, WithStyles};
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

final class LaporanFormAExport implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting, WithColumnWidths
{
    public function __construct(
        public int $urusanId,
        public ?int $bidangUrusanId,
        public string $waktu,
        public ?int $subOpdId = null,
        public string $jenisLaporan = 'a'
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
        return match ($this->jenisLaporan) {
            'a' => [
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
            ],
            'b' => [
                'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'C1:C15' => NumberFormat::FORMAT_GENERAL,
                'E:K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'E12:O15' => NumberFormat::FORMAT_GENERAL,

                'K' => NumberFormat::FORMAT_PERCENTAGE_00,
                'L' => NumberFormat::FORMAT_PERCENTAGE_00,
                'L1:L15' => NumberFormat::FORMAT_GENERAL,
                'K1:K15' => NumberFormat::FORMAT_GENERAL,
            ],
            'c' => [
                'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'C1:C15' => NumberFormat::FORMAT_GENERAL,
                'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'D12:H15' => NumberFormat::FORMAT_GENERAL,

                'E' => NumberFormat::FORMAT_PERCENTAGE_00,
                'F' => NumberFormat::FORMAT_PERCENTAGE_00,
                'E1:E15' => NumberFormat::FORMAT_GENERAL,
                'F1:F15' => NumberFormat::FORMAT_GENERAL,
            ],
            'semester' => [
                'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'C1:C15' => NumberFormat::FORMAT_GENERAL,
                'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'D11:H15' => NumberFormat::FORMAT_GENERAL,

                'F' => NumberFormat::FORMAT_PERCENTAGE_00,
                'G' => NumberFormat::FORMAT_PERCENTAGE_00,
                'E1:E15' => NumberFormat::FORMAT_GENERAL,
                'F1:F15' => NumberFormat::FORMAT_GENERAL,
            ]
        };
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A3:A5')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B')->getAlignment()->setWrapText(true);
        $sheet->getStyle($this->jenisLaporan == 'a' ? 'A11:N15' : 'A11:O15')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('C')->getAlignment()->setHorizontal('right')->setVertical('center');
        $sheet->getStyle('C1:C15')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle($this->jenisLaporan == 'a' ? 'A11:N15' : 'A11:O15')->getFont()->setBold(true);
    }

    public function view(): View
    {
        $waktu = CarbonImmutable::createFromFormat('Y-m-d', $this->waktu);
        $namaPeriode = match ($this->jenisLaporan) {
            'a' => 'Bulan '.$waktu->translatedFormat('F').' '.cache('tahapanApbd')->tahun,
            'b' => 'Triwulan '.$waktu->quarter,
            'c' => 'Tahun '.cache('tahapanApbd')->tahun,
            'semester' => 'Semester '.(str($this->waktu)->contains('01-01') ? 1 : 2)
        };

        $periodeLaluMulai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->subMonth(1)->toDateString() : $waktu->startOfQuarter()->subQuarter(1)->toDateString();
        $periodeLaluSelesai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->subMonth(1)->endOfMonth()->toDateString() : $waktu->startOfQuarter()->subQuarter()->endOfQuarter()->toDateString();

        $periodeIniMulai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->toDateString() : $waktu->startOfQuarter()->toDateString();
        $periodeIniSelesai = match ($this->jenisLaporan) {
            'a' => $waktu->endOfMonth()->toDateString(),
            'semester' => $waktu->endOfYear()->toDateString(),
            default => $waktu->endOfQuarter()->toDateString()
        };

        $sdPeriodeIniMulai = $waktu->startOfYear()->toDateString();
        $sdPeriodeIniSelesai = $waktu->toDateString();

        $selectUntukPeriodeLalu = '';
        $selectUntukPeriodeSdIni = '';
        if ($this->jenisLaporan != 'semester') {
            $selectUntukPeriodeLalu = "SUM(IF(r.tanggal BETWEEN '{$periodeLaluMulai}' AND '{$periodeLaluSelesai}', r.jumlah, 0)) AS realisasi_bulan_lalu,
            SUM(IF(r.tanggal BETWEEN '{$periodeLaluMulai}' AND '{$periodeLaluSelesai}', or.anggaran, 0)) AS anggaran_bulan_lalu,
            SUM(IF(rf.tanggal BETWEEN '{$periodeLaluMulai}' AND '{$periodeLaluSelesai}', rf.jumlah, 0)) AS realisasi_fisik_bulan_lalu,";

            $selectUntukPeriodeSdIni = "SUM(IF(r.tanggal BETWEEN '{$sdPeriodeIniMulai}' AND '{$sdPeriodeIniSelesai}', r.jumlah, 0)) AS realisasi_sd_bulan_ini,
            SUM(IF(r.tanggal BETWEEN '{$sdPeriodeIniMulai}' AND '{$sdPeriodeIniSelesai}', or.anggaran, 0)) AS anggaran_sd_bulan_ini,
            SUM(IF(rf.tanggal BETWEEN '{$sdPeriodeIniMulai}' AND '{$sdPeriodeIniSelesai}', rf.jumlah, 0)) AS realisasi_fisik_sd_bulan_ini,";
        }

        $opds = DB::table('objek_realisasis AS or')
            ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')
            ->leftJoin('realisasi_fisiks AS rf', 'rf.objek_realisasi_id', '=', 'or.id')
            ->join('sub_kegiatans AS sk', 'sk.id', '=', 'or.sub_kegiatan_id')
            ->join('kegiatans AS k', 'sk.kegiatan_id', '=', 'k.id')
            ->join('programs AS p', 'k.program_id', '=', 'p.id')

            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'or.bidang_urusan_sub_opd_id')
            ->join('bidang_urusans AS bu', 'bu.id', '=', 'buso.bidang_urusan_id')
            ->join('urusans AS u', 'u.id', '=', 'bu.urusan_id')

            ->join('sub_opds AS so', 'so.id', '=', 'buso.sub_opd_id')
            ->join('opds AS o', 'o.id', '=', 'so.opd_id')

            ->join('rincian_belanjas AS rb', 'rb.id', '=', 'or.rincian_belanja_id')
            ->join('sub_rincian_objek_belanjas AS srob', 'srob.id', '=', 'rb.sub_rincian_objek_belanja_id')
            ->join('rincian_objek_belanjas AS rob', 'rob.id', '=', 'srob.rincian_objek_belanja_id')
            ->join('objek_belanjas AS ob', 'ob.id', '=', 'rob.objek_belanja_id')
            ->join('jenis_belanjas AS jb', 'jb.id', '=', 'ob.jenis_belanja_id')
            ->join('kelompok_belanjas AS kb', 'kb.id', '=', 'jb.kelompok_belanja_id')
            ->join('akun_belanjas AS ab', 'ab.id', '=', 'kb.akun_belanja_id')

            ->selectRaw("u.kode AS kode_urusan, bu.kode AS kode_bidang_urusan, p.kode AS kode_program, k.kode AS kode_kegiatan, sk.kode AS kode_sub_kegiatan,ab.kode AS kode_belanja_1, ab.nama AS nama_belanja_1, kb.kode AS kode_belanja_2, kb.nama AS nama_belanja_2, jb.kode AS kode_belanja_3, jb.nama AS nama_belanja_3, ob.kode AS kode_belanja_4, ob.nama AS nama_belanja_4, rob.kode AS kode_belanja_5, rob.nama AS nama_belanja_5, srob.kode AS kode_belanja_6, srob.nama AS nama_belanja_6, p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, SUM(or.anggaran) AS anggaran,

            {$selectUntukPeriodeLalu}

            SUM(IF(r.tanggal BETWEEN '{$periodeIniMulai}' AND '{$periodeIniSelesai}', r.jumlah, 0)) AS realisasi_bulan_ini,
            SUM(IF(r.tanggal BETWEEN '{$periodeIniMulai}' AND '{$periodeIniSelesai}', or.anggaran, 0)) AS anggaran_bulan_ini,
            SUM(IF(rf.tanggal BETWEEN '{$periodeIniMulai}' AND '{$periodeIniSelesai}', rf.jumlah, 0)) AS realisasi_fisik_bulan_ini,

            {$selectUntukPeriodeSdIni}

            SUM(IF(kb.kode = 1, or.anggaran, 0)) AS anggaran_belanja_operasi,
            SUM(IF(kb.kode = 2, or.anggaran, 0)) AS anggaran_belanja_modal,
            SUM(IF(kb.kode = 3, or.anggaran, 0)) AS anggaran_belanja_tidak_terduga,
            SUM(IF(kb.kode = 4, or.anggaran, 0)) AS anggaran_belanja_transfer")
            ->where('or.tahapan_apbd_id', cache('tahapanApbd')->id)
            ->where('or.anggaran', '!=', 0)
            ->where('u.id', $this->urusanId)
            ->when(filled($this->bidangUrusanId), function ($query) {
                $query->where('bu.id', $this->bidangUrusanId);
            })
            ->when(filled($this->subOpdId), function ($query) {
                $query->where('so.id', $this->subOpdId);
            })
            ->groupByRaw('ab.kode, ab.nama, kb.kode, kb.nama, u.kode, bu.kode, p.kode, p.nama, k.kode, k.nama, sk.kode, sk.nama, jb.kode, jb.nama, ob.kode, ob.nama, rob.kode, rob.nama, srob.kode, srob.nama')
            ->orderByRaw('ab.kode, ab.nama, kb.kode, kb.nama, u.kode, bu.kode, p.kode, p.nama, k.kode, k.nama, sk.kode, sk.nama, jb.kode, jb.nama, ob.kode, ob.nama, rob.kode, rob.nama, srob.kode, srob.nama')
            // ->dd()
            ->get();

        $urusan = Urusan::find($this->urusanId);
        $namaBidangUrusan = filled($this->bidangUrusanId) ? BidangUrusan::find($this->bidangUrusanId)->nama : null;
        $opd = Opd::find(config('app.opd_id'));
        // dd($opd);
        $subOpd = filled($this->subOpdId) ? SubOpd::find($this->subOpdId) : null;
        $jenisLaporan = $this->jenisLaporan;
        $view = match ($this->jenisLaporan) {
            'a' => 'exports.laporan-form-a-export',
            'b' => 'exports.laporan-form-b-export',
            'c' => 'exports.laporan-form-c-export',
            'semester' => 'exports.laporan-semester-export'
        };

        return view($view, compact('opds', 'urusan', 'namaBidangUrusan', 'opd', 'subOpd', 'namaPeriode', 'jenisLaporan'));
    }
}
