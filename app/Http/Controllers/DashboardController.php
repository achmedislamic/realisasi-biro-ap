<?php

namespace App\Http\Controllers;

use App\Models\ObjekRealisasi;
use App\Models\Realisasi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // saya ada fitur baru nih

        //fitur baru lagi
        $anggaran = ObjekRealisasi::query()
            ->doesntHave('realisasis')
            ->when(auth()->user()->isOpd(), function (Builder $query) {
                $query->whereRelation('bidangUrusanSubOpd.subOpd', 'opd_id', '=', auth()->id());
            })
            ->when(auth()->user()->isSubOpd(), function (Builder $query) {
                $query->whereRelation('bidangUrusanSubOpd.subOpd', 'id', '=', auth()->id());
            })
            ->sum('anggaran');

        $realisasi = Realisasi::query()
            ->whereRelation('objekRealisasi', 'tahapan_apbd_id', cache('tahapanApbd')->id)
            ->when(auth()->user()->isOpd(), function (Builder $query) {
                $query->whereRelation('objekRealisasi.bidangUrusanSubOpd.subOpd', 'opd_id', '=', auth()->id());
            })
            ->when(auth()->user()->isSubOpd(), function (Builder $query) {
                $query->whereRelation('objekRealisasi.bidangUrusanSubOpd.subOpd', 'id', '=', auth()->id());
            })
            ->sum('jumlah');
        return view('dashboard', compact('anggaran', 'realisasi'));
    }
}
