<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait PerhitunganAnggaranRealisasiDashboard
{
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

        return ", SUM(IF(rf.tanggal BETWEEN '{$januariMulai}' AND '{$januariSelesai}', rf.jumlah, 0)) AS realisasi_fisik_1, SUM(IF(rf.tanggal BETWEEN '{$februariMulai}' AND '{$februariSelesai}', rf.jumlah, 0)) AS realisasi_fisik_2, SUM(IF(rf.tanggal BETWEEN '{$maretMulai}' AND '{$maretSelesai}', rf.jumlah, 0)) AS realisasi_fisik_3, SUM(IF(rf.tanggal BETWEEN '{$aprilMulai}' AND '{$aprilSelesai}', rf.jumlah, 0)) AS realisasi_fisik_4, SUM(IF(rf.tanggal BETWEEN '{$meiMulai}' AND '{$meiSelesai}', rf.jumlah, 0)) AS realisasi_fisik_5, SUM(IF(rf.tanggal BETWEEN '{$juniMulai}' AND '{$juniSelesai}', rf.jumlah, 0)) AS realisasi_fisik_6, SUM(IF(rf.tanggal BETWEEN '{$juliMulai}' AND '{$juliSelesai}', rf.jumlah, 0)) AS realisasi_fisik_7, SUM(IF(rf.tanggal BETWEEN '{$agustusMulai}' AND '{$agustusSelesai}', rf.jumlah, 0)) AS realisasi_fisik_8, SUM(IF(rf.tanggal BETWEEN '{$septemberMulai}' AND '{$septemberSelesai}', rf.jumlah, 0)) AS realisasi_fisik_9, SUM(IF(rf.tanggal BETWEEN '{$oktoberMulai}' AND '{$oktoberSelesai}', rf.jumlah, 0)) AS realisasi_fisik_10, SUM(IF(rf.tanggal BETWEEN '{$novemberMulai}' AND '{$novemberSelesai}', rf.jumlah, 0)) AS realisasi_fisik_11, SUM(IF(rf.tanggal BETWEEN '{$desemberMulai}' AND '{$desemberSelesai}', rf.jumlah, 0)) AS realisasi_fisik_12,

        SUM(IF(rf.tanggal BETWEEN '{$triwulan1Mulai}' AND '{$triwulan1Selesai}', rf.jumlah, 0)) AS realisasi_triwulan_fisik_1, SUM(IF(rf.tanggal BETWEEN '{$triwulan2Mulai}' AND '{$triwulan2Selesai}', rf.jumlah, 0)) AS realisasi_triwulan_fisik_2, SUM(IF(rf.tanggal BETWEEN '{$triwulan3Mulai}' AND '{$triwulan3Selesai}', rf.jumlah, 0)) AS realisasi_triwulan_fisik_3, SUM(IF(rf.tanggal BETWEEN '{$triwulan4Mulai}' AND '{$triwulan4Selesai}', rf.jumlah, 0)) AS realisasi_triwulan_fisik_4, SUM(IF(rf.tanggal BETWEEN '{$semester1Mulai}' AND '{$semester1Selesai}', rf.jumlah, 0)) AS realisasi_semester_fisik_1, SUM(IF(rf.tanggal BETWEEN '{$semester2Mulai}' AND '{$semester2Selesai}', rf.jumlah, 0)) AS realisasi_semester_fisik_2,

        SUM(IF(r.tanggal BETWEEN '{$januariMulai}' AND '{$januariSelesai}', r.jumlah, 0)) AS realisasi_1, SUM(IF(r.tanggal BETWEEN '{$februariMulai}' AND '{$februariSelesai}', r.jumlah, 0)) AS realisasi_2, SUM(IF(r.tanggal BETWEEN '{$maretMulai}' AND '{$maretSelesai}', r.jumlah, 0)) AS realisasi_3, SUM(IF(r.tanggal BETWEEN '{$aprilMulai}' AND '{$aprilSelesai}', r.jumlah, 0)) AS realisasi_4, SUM(IF(r.tanggal BETWEEN '{$meiMulai}' AND '{$meiSelesai}', r.jumlah, 0)) AS realisasi_5, SUM(IF(r.tanggal BETWEEN '{$juniMulai}' AND '{$juniSelesai}', r.jumlah, 0)) AS realisasi_6, SUM(IF(r.tanggal BETWEEN '{$juliMulai}' AND '{$juliSelesai}', r.jumlah, 0)) AS realisasi_7, SUM(IF(r.tanggal BETWEEN '{$agustusMulai}' AND '{$agustusSelesai}', r.jumlah, 0)) AS realisasi_8, SUM(IF(r.tanggal BETWEEN '{$septemberMulai}' AND '{$septemberSelesai}', r.jumlah, 0)) AS realisasi_9, SUM(IF(r.tanggal BETWEEN '{$oktoberMulai}' AND '{$oktoberSelesai}', r.jumlah, 0)) AS realisasi_10, SUM(IF(r.tanggal BETWEEN '{$novemberMulai}' AND '{$novemberSelesai}', r.jumlah, 0)) AS realisasi_11, SUM(IF(r.tanggal BETWEEN '{$desemberMulai}' AND '{$desemberSelesai}', r.jumlah, 0)) AS realisasi_12, SUM(IF(r.tanggal BETWEEN '{$triwulan1Mulai}' AND '{$triwulan1Selesai}', r.jumlah, 0)) AS realisasi_triwulan_1, SUM(IF(r.tanggal BETWEEN '{$triwulan2Mulai}' AND '{$triwulan2Selesai}', r.jumlah, 0)) AS realisasi_triwulan_2, SUM(IF(r.tanggal BETWEEN '{$triwulan3Mulai}' AND '{$triwulan3Selesai}', r.jumlah, 0)) AS realisasi_triwulan_3, SUM(IF(r.tanggal BETWEEN '{$triwulan4Mulai}' AND '{$triwulan4Selesai}', r.jumlah, 0)) AS realisasi_triwulan_4, SUM(IF(r.tanggal BETWEEN '{$semester1Mulai}' AND '{$semester1Selesai}', r.jumlah, 0)) AS realisasi_semester_1, SUM(IF(r.tanggal BETWEEN '{$semester2Mulai}' AND '{$semester2Selesai}', r.jumlah, 0)) AS realisasi_semester_2";
    }

    private function table(): Builder
    {
        return DB::table('opds AS o')
            ->join('sub_opds AS so', 'so.opd_id', '=', 'o.id')
            ->join('bidang_urusan_sub_opds AS buso', 'buso.sub_opd_id', '=', 'so.id')
            ->leftJoin('objek_realisasis AS or', 'or.bidang_urusan_sub_opd_id', '=', 'buso.id')
            ->leftJoin('realisasis AS r', 'r.objek_realisasi_id', '=', 'or.id')
            ->leftJoin('realisasi_fisiks AS rf', 'rf.objek_realisasi_id', '=', 'or.id')
            ->where('or.tahapan_apbd_id', cache('tahapanApbd')->id);
    }

    protected function opds()
    {
        $select = "o.nama AS nama_pd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi, SUM(rf.jumlah) AS realisasi_fisik{$this->realisasiBulananQuery()}, 0 AS is_biro";
        
        return $this->table()
            ->when(auth()->user()->isSektor(), function (Builder $query) {
                $query->where('o.sektor_id', auth()->user()->role->imageable_id);
            })
            ->when(auth()->user()->isAdmin() || auth()->user()->isSektor(), function (Builder $query) use ($select) {
                $query->selectRaw("o.id AS id, " . $select)
                    ->where('o.nama', '!=', 'Sekretariat Daerah')
                    ->groupByRaw('o.nama, o.id')
                    ->orderBy('o.nama');
            })
            ->when(auth()->user()->isSubOpd(), function (Builder $query) use ($select) {
                $query->where('o.id', auth()->user()->role->imageable_id)
                    ->selectRaw("so.id AS id, " . $select)
                    ->groupByRaw('so.nama, so.id')
                    ->orderBy('so.nama');
            })
            ->get();
    }

    protected function subOpds(string|int $where = null): Collection
    {
        if(is_null($where)){
            return collect();
        }

        $select = "so.id, so.nama AS nama_pd, SUM(or.anggaran) AS anggaran, SUM(r.jumlah) AS realisasi, SUM(rf.jumlah) AS realisasi_fisik{$this->realisasiBulananQuery()}";
        if($where == 'sekretariat daerah'){
            $select = $select . ', 1 AS is_biro';
        }

        return $this->table()
                ->selectRaw($select)
                ->when($where == 'sekretariat daerah', fn ($query) => $query->where('o.nama', 'like', '%Sekretariat Daerah%'))
                ->when(is_int($where), fn ($query) => $query->where('o.id', $where))
                ->groupByRaw('so.nama, so.id')
                ->orderBy('so.nama')
                // ->dd()
                ->get();
    }

    protected function colspanRealisasi(string $periode): int
    {
        return match($periode){
            'bulan' => 36,
            'triwulan' => 12,
            'semester' => 6,
            'tahun' => 3,
            default => 0
        };
    }

    protected function foreachCount(string $periode): int
    {
        return match ($periode) {
            'bulan' => 12,
            'triwulan' => 4,
            'semester' => 2,
            'tahun' => 1,
            default => 0
        };
    }
}
