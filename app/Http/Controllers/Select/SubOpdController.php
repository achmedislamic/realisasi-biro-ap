<?php

namespace App\Http\Controllers\Select;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\SubOpd;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SubOpdController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Collection
    {
        return SubOpd::query()
            ->where('opd_id', request('opdId'))
            ->selectRaw('id, CONCAT(kode, " ", nama) AS nama')
            ->orderBy('kode')
            ->orderBy('nama')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('nama', 'like', "%{$request->search}%")
                    ->orWhere('kode', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(50)
            )
            ->get();
    }
}
