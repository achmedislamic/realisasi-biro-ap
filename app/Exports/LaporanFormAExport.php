<?php

namespace App\Exports;

use App\Models\BidangUrusan;
use App\Models\Opd;
use App\Models\SubOpd;
use App\Models\Urusan;
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
        public string $waktu,
        public int $opdId,
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
        $waktu = CarbonImmutable::createFromFormat('Y-m-d', $this->waktu);
        $namaPeriode = $this->jenisLaporan == 'a' ? 'Bulan ' . $waktu->translatedFormat('F') . ' ' . cache('tahapanApbd')->tahun : 'Triwulan ' . $waktu->quarter;

        $bulanLaluMulai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->subMonth(1)->toDateString() : $waktu->startOfQuarter()->subQuarter(1)->toDateString();
        $bulanLaluSelesai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->subMonth(1)->endOfMonth()->toDateString() : $waktu->startOfQuarter()->subQuarter()->endOfQuarter()->toDateString();

        $bulanIniMulai = $this->jenisLaporan == 'a' ? $waktu->startOfMonth()->toDateString() : $waktu->startOfQuarter()->toDateString();
        $bulanIniSelesai = $this->jenisLaporan == 'a' ? $waktu->endOfMonth()->toDateString() : $waktu->endOfQuarter()->toDateString();

        $sdBulanIniMulai = $waktu->startOfYear()->toDateString();
        $sdBulanIniSelesai = $waktu->toDateString();

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

            ->join('sub_rincian_objek_belanjas AS srob', 'srob.id', '=', 'or.sub_rincian_objek_belanja_id')
            ->join('rincian_objek_belanjas AS rob', 'rob.id', '=', 'srob.rincian_objek_belanja_id')
            ->join('objek_belanjas AS ob', 'ob.id', '=', 'rob.objek_belanja_id')
            ->join('jenis_belanjas AS jb', 'jb.id', '=', 'ob.jenis_belanja_id')
            ->join('kelompok_belanjas AS kb', 'kb.id', '=', 'jb.kelompok_belanja_id')
            ->join('akun_belanjas AS ab', 'ab.id', '=', 'kb.akun_belanja_id')

            ->selectRaw("u.kode AS kode_urusan, bu.kode AS kode_bidang_urusan, p.kode AS kode_program, k.kode AS kode_kegiatan, sk.kode AS kode_sub_kegiatan,ab.kode AS kode_belanja_1, ab.nama AS nama_belanja_1, kb.kode AS kode_belanja_2, kb.nama AS nama_belanja_2, jb.kode AS kode_belanja_3, jb.nama AS nama_belanja_3, ob.kode AS kode_belanja_4, ob.nama AS nama_belanja_4, rob.kode AS kode_belanja_5, rob.nama AS nama_belanja_5, srob.kode AS kode_belanja_6, srob.nama AS nama_belanja_6, p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, SUM( or.anggaran) AS anggaran, SUM(IF(r.tanggal BETWEEN '{$bulanLaluMulai}' AND '{$bulanLaluSelesai}', r.jumlah, 0)) AS realisasi_bulan_lalu, SUM(IF(r.tanggal BETWEEN '{$bulanIniMulai}' AND '{$bulanIniSelesai}', r.jumlah, 0)) AS realisasi_bulan_ini, SUM(IF(r.tanggal BETWEEN '{$sdBulanIniMulai}' AND '{$sdBulanIniSelesai}', r.jumlah, 0)) AS realisasi_sd_bulan_ini")
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
            ->groupByRaw('ab.kode, ab.nama, kb.kode, kb.nama, u.kode, bu.kode, p.kode, p.nama, k.kode, k.nama, sk.kode, sk.nama, jb.kode, jb.nama, ob.kode, ob.nama, rob.kode, rob.nama, srob.kode, srob.nama')
            ->orderByRaw('ab.kode, ab.nama, kb.kode, kb.nama, u.kode, bu.kode, p.kode, p.nama, k.kode, k.nama, sk.kode, sk.nama, jb.kode, jb.nama, ob.kode, ob.nama, rob.kode, rob.nama, srob.kode, srob.nama')
            // ->dd()
            ->get();

        $urusan = Urusan::find($this->urusanId);
        $namaBidangUrusan = filled($this->bidangUrusanId) ? BidangUrusan::find($this->bidangUrusanId)->nama : null;
        $opd = Opd::find($this->opdId);
        $subOpd = filled($this->subOpdId) ? SubOpd::find($this->subOpdId) : null;
        $jenisLaporan = $this->jenisLaporan;
        return view($this->jenisLaporan == 'a' ? 'exports.laporan-form-a-export' : 'exports.laporan-form-b-export', compact('opds', 'urusan', 'namaBidangUrusan', 'opd', 'subOpd', 'namaPeriode', 'jenisLaporan'));
    }
}
