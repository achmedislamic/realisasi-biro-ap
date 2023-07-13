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
        $opds = auth()->user()->isAdmin() ? $this->subOpds(1) : collect();

        [$targetOpds, $colspanRealisasi, $foreachCount] = [Target::all(), $this->colspanRealisasi($this->periode), $this->foreachCount($this->periode)];

        return view('livewire.table-dashboard', compact('opds', 'targetOpds', 'colspanRealisasi', 'foreachCount'));
    }
}
