<?php

namespace App\Exports;

use App\Models\Opd;
use App\Models\SubKegiatan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanFormAExport implements FromView
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

    public function view(): View
    {
        $bulan = Carbon::createFromFormat('Y-m-d', '2024-06-06');
        $bulanLaluMulai = $bulan->subMonth(1)->startOfMonth()->toDateString();
        $bulanLaluSelesai = $bulan->subMonth(1)->endOfMonth()->toDateString();

        $bulanIniMulai = $bulan->startOfMonth()->toDateString();
        $bulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $sdBulanIniMulai = $bulan->startOfYear()->toDateString();
        $sdBulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $opds = SubKegiatan::query()
            ->join('kegiatans AS k', 'sub_kegiatans.kegiatan_id', '=', 'k.id')
            ->join('programs AS p', 'k.program_id', '=', 'p.id')
            ->join('objek_realisasis AS or', 'or.sub_kegiatan_id', '=', 'sub_kegiatans.id')
            ->join('realisasis AS r', 'or.id', '=', 'r.objek_realisasi_id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.id', '=', 'or.bidang_urusan_sub_opd_id')
            ->join('sub_opds AS so', 'so.id', '=', 'buso.sub_opd_id')
            ->join('opds', 'opds.id', '=', 'so.opd_id')

            ->selectRaw("p.nama AS nama_program, k.nama AS nama_kegiatan, sub_kegiatans.nama AS nama_sub_kegiatan, or.anggaran, SUM(IF(r.tanggal BETWEEN {$bulanLaluMulai} AND {$bulanLaluSelesai}, r.jumlah, 0)) AS realisasi_bulan_lalu, SUM(IF(r.tanggal BETWEEN {$bulanIniMulai} AND {$bulanIniSelesai}, r.jumlah, 0)) AS realisasi_bulan_ini, SUM(IF(r.tanggal BETWEEN {$sdBulanIniMulai} AND {$sdBulanIniSelesai}, r.jumlah, 0)) AS realisasi_sd_bulan_ini, opds.id AS opd_id, so.id AS sub_opd_id, or.tahapan_apbd_id, or.bidang_urusan_sub_opd_id, or.sub_kegiatan_id, or.sub_rincian_objek_belanja_id, p.id AS program_id, k.id AS kegiatan_id")
            ->groupBy('sub_kegiatans.nama, k.nama, p.nama, or.anggaran, opds.id, so.id, or.tahapan_apbd_id,
            or.bidang_urusan_sub_opd_id, or.sub_kegiatan_id, or.sub_rincian_objek_belanja_id')
            ->dd()
            ->get();

        return view('exports.laporan-form-a-export', compact('opds'));
    }
}
