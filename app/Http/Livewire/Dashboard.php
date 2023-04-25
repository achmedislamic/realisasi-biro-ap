<?php

namespace App\Http\Livewire;

use App\Models\Target;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $periode = 'bulan';

    public function render()
    {
        // nama_opd, anggaran, realisasi, persentase
        $opds = DB::table('opds AS o')
            ->join('sub_opds AS so', 'so.opd_id', '=', 'o.id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
            ->leftJoin('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
            ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')

            ->when(auth()->user()->isAdmin(), function (Builder $query) {
                $query->selectRaw('o.nama AS nama_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi')
                    ->groupBy('o.nama')
                    ->orderBy('o.nama');
            }, function (Builder $query) {
                $query->where('o.id', auth()->user()->role->imageable_id)
                    ->selectRaw('so.nama AS nama_sub_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi')
                    ->groupBy('so.nama')
                    ->orderBy('so.nama');
            })

            ->get();

        $biros = collect();
        $targetBiros = collect();
        if (auth()->user()->isAdmin()) {
            //dapatkan semua target dulu
            $targetBiros = Target::where('targetable_type', 'sub_opd')->get();

            $januariMulai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->toDateString();
            $januariSelesai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->endOfMonth()->toDateString();

            $biros = DB::table('opds AS o')
                ->join('sub_opds AS so', 'so.opd_id', '=', 'o.id')
                ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
                ->leftJoin('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
                ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')

                ->selectRaw("so.nama AS nama_sub_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi, SUM(IF(r.tanggal BETWEEN '{$januariMulai}' AND '{$januariSelesai}', r.jumlah, 0)) AS realisasi_1, so.id")
                ->where('o.nama', 'like', '%Sekretariat Daerah%')
                ->groupByRaw('so.nama, so.id')
                ->orderBy('so.nama')
                // ->dd()
                ->get();
        }

        return view('livewire.dashboard', compact('opds', 'biros', 'targetBiros'));
    }
}
