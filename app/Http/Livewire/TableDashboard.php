<?php

namespace App\Http\Livewire;

use App\Models\Target;
use App\Traits\PerhitunganAnggaranRealisasiDashboard;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class TableDashboard extends Component
{
    use PerhitunganAnggaranRealisasiDashboard;

    public $periode = 'bulan';

    public $urutan = 'asc';

    protected $queryString = ['periode' => ['except' => '']];

    public function render(): View
    {
        // nama_opd, anggaran, realisasi, persentase
        $targetOpds = Target::where('targetable_type', 'opd')->get();
        $targetBiros = Target::where('targetable_type', 'sub_opd')->get();
        $biros = collect();
        $opds = $this->opds();


        if (auth()->user()->isAdmin()) {
            $biros = $this->subOpds('sekretariat daerah');
            // dd($opds->merge($biros));
        }

        $colspanRealisasi = $this->colspanRealisasi($this->periode);

        $foreachCount = $this->foreachCount($this->periode);

        return view('livewire.table-dashboard', compact('opds', 'biros', 'targetBiros', 'targetOpds', 'colspanRealisasi', 'foreachCount'));
    }
}
