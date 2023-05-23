<?php

namespace App\Http\Controllers\Select;

use App\Http\Controllers\Controller;
use App\Models\SubRincianObjekBelanja;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SubRincianObjekBelanjaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Collection
    {
        return SubRincianObjekBelanja::query()
            ->join('rincian_objek_belanjas AS rob', 'rob.id', '=', 'sub_rincian_objek_belanjas.rincian_objek_belanja_id')
            ->join('objek_belanjas AS ob', 'ob.id', '=', 'rob.objek_belanja_id')
            ->join('jenis_belanjas AS jb', 'jb.id', '=', 'ob.jenis_belanja_id')
            ->join('kelompok_belanjas AS kb', 'kb.id', '=', 'jb.kelompok_belanja_id')
            ->join('akun_belanjas AS ab', 'ab.id', '=', 'kb.akun_belanja_id')
            ->selectRaw('sub_rincian_objek_belanjas.id, CONCAT(ab.kode, kb.kode, ".", jb.kode, ".", ob.kode, ".", sub_rincian_objek_belanjas.kode, " ", sub_rincian_objek_belanjas.nama) AS nama')
            ->orderBy('sub_rincian_objek_belanjas.nama')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('sub_rincian_objek_belanjas.nama', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('sub_rincian_objek_belanjas.id', $request->input('selected', []))
            )
            ->get();
    }
}
