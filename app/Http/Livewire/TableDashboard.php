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
        $targetSubOpds = Target::where('targetable_type', 'sub_opd')->get();
        $subOpds = collect();
        $opds = collect();

        if (auth()->user()->isAdmin()) {
            $opds = $this->opds();
            $subOpds = $this->subOpds('sekretariat daerah');
        }

        if(auth()->user()->isOpd()){
            $subOpds = $this->subOpds(auth()->user()->role->imageable_id);
        }

        $colspanRealisasi = $this->colspanRealisasi($this->periode);

        $foreachCount = $this->foreachCount($this->periode);

        return view('livewire.table-dashboard', compact('opds', 'subOpds', 'targetSubOpds', 'targetOpds', 'colspanRealisasi', 'foreachCount'));
    }
}
