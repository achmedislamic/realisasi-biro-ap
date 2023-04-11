<?php

namespace App\Http\Controllers;

use App\Models\TahapanApbd;
use Illuminate\Http\Request;

class PilihTahunAnggaranController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->user()->isNotAdmin()) {
            cache()->forever('tahapanApbd', TahapanApbd::latest()->first());

            return to_route('dashboard');
        }

        return view('pilih-tahun-anggaran');
    }
}
