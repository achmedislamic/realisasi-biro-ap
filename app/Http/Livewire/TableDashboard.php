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
        $targetOpds = Target::all();

        $subOpds = auth()->user()->isAdmin() ? $this->subOpds('sekretariat daerah') : $this->subOpds(auth()->user()->role->imageable_id);
        $opds = auth()->user()->isAdmin() ? $this->opds() : collect();

        $colspanRealisasi = $this->colspanRealisasi($this->periode);

        $foreachCount = $this->foreachCount($this->periode);

        $opds = $opds->merge($subOpds)->sortBy('nama_pd');

        return view('livewire.table-dashboard', compact('opds', 'targetOpds', 'colspanRealisasi', 'foreachCount'));
    }
}
