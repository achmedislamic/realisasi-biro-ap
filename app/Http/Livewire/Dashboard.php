<?php

namespace App\Http\Livewire;

use App\Models\Target;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $periode = 'bulan';

    private function realisasiBulananQuery(): string
    {
        $triwulan1Mulai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->toDateString();
        $triwulan1Selesai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->endOfQuarter()->toDateString();

        $triwulan2Mulai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter()->toDateString();
        $triwulan2Selesai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter()->endOfQuarter()->toDateString();

        $triwulan3Mulai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter(2)->toDateString();
        $triwulan3Selesai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter(2)->endOfQuarter()->toDateString();

        $triwulan4Mulai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter(3)->toDateString();
        $triwulan4Selesai = today()->setYear(cache('tahapanApbd')->tahun)->startOfYear()->addQuarter(3)->endOfQuarter()->toDateString();

        $semester1Mulai = $triwulan1Mulai;
        $semester1Selesai = $triwulan2Selesai;

        $semester2Mulai = $triwulan3Mulai;
        $semester2Selesai = $triwulan4Selesai;

        $januariMulai = $triwulan1Mulai;
        $januariSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(1)->endOfMonth()->toDateString();

        $februariMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(2)->startOfMonth()->toDateString();
        $februariSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(2)->endOfMonth()->toDateString();

        $maretMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(3)->startOfMonth()->toDateString();
        $maretSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(3)->endOfMonth()->toDateString();

        $aprilMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(4)->startOfMonth()->toDateString();
        $aprilSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(4)->endOfMonth()->toDateString();

        $meiMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(5)->startOfMonth()->toDateString();
        $meiSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(5)->endOfMonth()->toDateString();

        $juniMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(6)->startOfMonth()->toDateString();
        $juniSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(6)->endOfMonth()->toDateString();

        $juliMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(7)->startOfMonth()->toDateString();
        $juliSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(7)->endOfMonth()->toDateString();

        $agustusMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(8)->startOfMonth()->toDateString();
        $agustusSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(8)->endOfMonth()->toDateString();

        $septemberMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(9)->startOfMonth()->toDateString();
        $septemberSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(9)->endOfMonth()->toDateString();

        $oktoberMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(10)->startOfMonth()->toDateString();
        $oktoberSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(10)->endOfMonth()->toDateString();

        $novemberMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(11)->startOfMonth()->toDateString();
        $novemberSelesai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(11)->endOfMonth()->toDateString();

        $desemberMulai = today()->setYear(cache('tahapanApbd')->tahun)->setMonth(12)->startOfMonth()->toDateString();
        $desemberSelesai = $triwulan4Selesai;

        return ", SUM(IF(r.tanggal BETWEEN '{$januariMulai}' AND '{$januariSelesai}', r.jumlah, 0)) AS realisasi_1, SUM(IF(r.tanggal BETWEEN '{$februariMulai}' AND '{$februariSelesai}', r.jumlah, 0)) AS realisasi_2, SUM(IF(r.tanggal BETWEEN '{$maretMulai}' AND '{$maretSelesai}', r.jumlah, 0)) AS realisasi_3, SUM(IF(r.tanggal BETWEEN '{$aprilMulai}' AND '{$aprilSelesai}', r.jumlah, 0)) AS realisasi_4, SUM(IF(r.tanggal BETWEEN '{$meiMulai}' AND '{$meiSelesai}', r.jumlah, 0)) AS realisasi_5, SUM(IF(r.tanggal BETWEEN '{$juniMulai}' AND '{$juniSelesai}', r.jumlah, 0)) AS realisasi_6, SUM(IF(r.tanggal BETWEEN '{$juliMulai}' AND '{$juliSelesai}', r.jumlah, 0)) AS realisasi_7, SUM(IF(r.tanggal BETWEEN '{$agustusMulai}' AND '{$agustusSelesai}', r.jumlah, 0)) AS realisasi_8, SUM(IF(r.tanggal BETWEEN '{$septemberMulai}' AND '{$septemberSelesai}', r.jumlah, 0)) AS realisasi_9, SUM(IF(r.tanggal BETWEEN '{$oktoberMulai}' AND '{$oktoberSelesai}', r.jumlah, 0)) AS realisasi_10, SUM(IF(r.tanggal BETWEEN '{$novemberMulai}' AND '{$novemberSelesai}', r.jumlah, 0)) AS realisasi_11, SUM(IF(r.tanggal BETWEEN '{$desemberMulai}' AND '{$desemberSelesai}', r.jumlah, 0)) AS realisasi_12, SUM(IF(r.tanggal BETWEEN '{$triwulan1Mulai}' AND '{$triwulan1Selesai}', r.jumlah, 0)) AS realisasi_triwulan_1, SUM(IF(r.tanggal BETWEEN '{$triwulan2Mulai}' AND '{$triwulan2Selesai}', r.jumlah, 0)) AS realisasi_triwulan_2, SUM(IF(r.tanggal BETWEEN '{$triwulan3Mulai}' AND '{$triwulan3Selesai}', r.jumlah, 0)) AS realisasi_triwulan_3, SUM(IF(r.tanggal BETWEEN '{$triwulan4Mulai}' AND '{$triwulan4Selesai}', r.jumlah, 0)) AS realisasi_triwulan_4, SUM(IF(r.tanggal BETWEEN '{$semester1Mulai}' AND '{$semester1Selesai}', r.jumlah, 0)) AS realisasi_semester_1, SUM(IF(r.tanggal BETWEEN '{$semester2Mulai}' AND '{$semester2Selesai}', r.jumlah, 0)) AS realisasi_semester_2";
    }

    public function render(): View
    {
        // nama_opd, anggaran, realisasi, persentase
        $targetOpds = Target::where('targetable_type', 'opd')->get();
        $targetBiros = Target::where('targetable_type', 'sub_opd')->get();
        $opds = DB::table('opds AS o')
            ->join('sub_opds AS so', 'so.opd_id', '=', 'o.id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
            ->leftJoin('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
            ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')

            ->when(auth()->user()->isAdmin(), function (Builder $query) {
                $query->selectRaw("o.id AS id, o.nama AS nama_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi{$this->realisasiBulananQuery()}")
                    ->where('o.nama', '!=', 'Sekretariat Daerah')
                    ->groupByRaw('o.nama, o.id')
                    ->orderBy('o.nama');
            }, function (Builder $query) {
                $query->where('o.id', auth()->user()->role->imageable_id)
                    ->selectRaw("so.id AS id, so.nama AS nama_sub_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi{$this->realisasiBulananQuery()}")
                    ->groupByRaw('so.nama, so.id')
                    ->orderBy('so.nama');
            })

            ->get();

        $biros = collect();
        $targetBiros = collect();
        if (auth()->user()->isAdmin()) {
            $biros = DB::table('opds AS o')
                ->join('sub_opds AS so', 'so.opd_id', '=', 'o.id')
                ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
                ->leftJoin('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
                ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')

                ->selectRaw("so.id, so.nama AS nama_sub_opd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi{$this->realisasiBulananQuery()}")
                ->where('o.nama', 'like', '%Sekretariat Daerah%')
                ->groupByRaw('so.nama, so.id')
                ->orderBy('so.nama')
                // ->dd()
                ->get();
        }

        return view('livewire.dashboard', compact('opds', 'biros', 'targetBiros', 'targetOpds'));
    }
}
