<?php

namespace App\Exports;

use App\Models\Opd;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanFormAExport implements FromView
{
    public function __construct(
        public int $urusanId,
        public string $bulan,
        public int $opdId,
        public ?int $subOpdId = null
    )
    {
        //
    }
    public function view(): View
    {
        $bulan = Carbon::createFromFormat('Y-m-d', $this->bulan);
        $bulanLaluMulai = $bulan->subMonth(1)->startOfMonth->toDateString();
        $bulanLaluSelesai = $bulan->subMonth(1)->endOfMonth->toDateString();

        $bulanIniMulai = $bulan->startOfMonth()->toDateString();
        $bulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $sdBulanIniMulai = $bulan->startOfYear()->toDateString();
        $sdBulanIniSelesai = $bulan->endOfMonth()->toDateString();

        $rows = Opd::query()
            ->join('sub_opds AS so', 'so.opd_id', '=', 'opds.id')
            ->join('objek_realisasis AS or', 'or.sub_opd_id', '=', 'so.id')
            ->join('realisasis AS r', 'or.id', '=', 'r.objek_realisasi_id')
            ->join('sub_kegiatans AS sk', 'or.sub_kegiatan_id', '=', 'sk.id')
            ->join('kegiatans AS k', 'sk.kegiatan_id', '=', 'k.id')
            ->join('programs AS p', 'k.program_id', '=', 'p.id')

            ->selectRaw("p.nama AS nama_program, k.nama AS nama_kegiatan, sk.nama AS nama_sub_kegiatan, or.anggaran, SUM(IF(r.tanggal BETWEEN {$bulanLaluMulai} AND {$bulanLaluSelesai}, r.jumlah, 0)) AS realisasi_bulan_lalu, SUM(IF(r.tanggal BETWEEN {$bulanIniMulai} AND {$bulanIniSelesai}, r.jumlah, 0)) AS realisasi_bulan_ini, SUM(IF(r.tanggal BETWEEN {$sdBulanIniMulai} AND {$sdBulanIniSelesai}, r.jumlah, 0)) AS realisasi_sd_bulan_ini, opds.id AS opd_id, so.id AS sub_opd_id, or.tahapan_apbd_id");

        return view('exports.laporan-form-a-export', compact('rows'));
    }
}
