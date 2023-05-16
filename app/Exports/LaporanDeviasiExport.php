<?php

namespace App\Exports;

use App\Models\Opd;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\JoinClause;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanDeviasiExport implements FromView
{
    public function __construct(public string $bulan)
    {
        //
    }

    public function view(): View
    {
        $rows = Opd::query()
            ->selectRaw('opds.nama AS nama_opd, SUM(or.anggaran) AS pagu, SUM(r.jumlah) AS realisasi, 1 AS deviasi, (SUM(r.jumlah) / SUM(or.anggaran) * 100) AS persen_realisasi_keuangan, 1 AS persen_deviasi_keuangan')
            ->join('sub_opds AS so', 'so.opd_id', '=', 'opds.id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
            ->join('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
            ->leftJoin('realisasis AS r', function (JoinClause $join) {
                $join->on('or.id', '=', 'r.objek_realisasi_id')
                    ->whereBetween('r.tanggal', [cache('tahapanApbd')->tahun.'-01-01', $this->bulan]);
            })
            ->groupBy('opds.id')
            ->orderBy('opds.nama')
            // ->dd()
            ->get();

        return view('exports.laporan-deviasi-export', [
            'rows' => $rows,
            'periode' => str(\Carbon\Carbon::createFromFormat('Y-m-d', $this->bulan)->translatedFormat('F Y'))->upper(),
        ]);
    }
}
