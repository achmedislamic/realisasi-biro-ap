<?php

namespace App\Exports;

use App\Models\{Opd, RincianMasalah, SubOpd};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{FromView, ShouldAutoSize, WithColumnWidths, WithStyles};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanFormEExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles
{
    public function __construct(
        public int $triwulan,
        public ?int $opdId = null,
        public ?int $subOpdId = null,
    ) {
        //
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
        $sheet->getStyle('A3:F3')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A3:F3')->getAlignment()->setHorizontal('center')->setVertical('center');
    }

    public function columnWidths(): array
    {
        return [
            'B' => 45,
        ];
    }

    public function view(): View
    {
        if(empty($this->opdId)){
            $this->opdId = auth()->user()->role->imageable_id;
        }
        return view('exports.laporan-form-e-export', [
            'opd' => Opd::find($this->opdId),
            'subOpd' => SubOpd::find($this->subOpdId),
            'periodeTeks' => match ($this->triwulan) {
                1 => 'TRIWULAN I TAHUN '.cache('tahapanApbd')->tahun,
                2 => 'TRIWULAN II TAHUN '.cache('tahapanApbd')->tahun,
                3 => 'TRIWULAN III TAHUN '.cache('tahapanApbd')->tahun,
                4 => 'TRIWULAN IV TAHUN '.cache('tahapanApbd')->tahun,
                0 => 'TAHUN '.cache('tahapanApbd')->tahun
            },
            'rincianMasalahs' => RincianMasalah::query()
                ->join('sub_kegiatans AS sk', 'sk.id', '=', 'rincian_masalahs.sub_kegiatan_id')
                ->join('kegiatans AS k', 'k.id', '=', 'sk.kegiatan_id')
                ->join('programs AS p', 'p.id', '=', 'k.program_id')

                ->join('sub_opds AS so', 'so.id', '=', 'rincian_masalahs.sub_opd_id')
                ->join('opds AS o', 'o.id', '=', 'so.opd_id')

                ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
                ->join('bidang_urusans AS bu', 'bu.id', '=', 'buso.bidang_urusan_id')
                ->join('urusans AS u', 'u.id', '=', 'bu.urusan_id')

                ->selectRaw('u.kode AS kode_urusan, bu.kode AS kode_bidang_urusan, p.kode AS kode_program, k.kode AS kode_kegiatan, sk.kode AS kode_sub_kegiatan, p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, rincian_masalahs.kendala, rincian_masalahs.tindak_lanjut, rincian_masalahs.pihak')
                ->get(),
        ]);
    }
}
