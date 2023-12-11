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

    public string $dataType = 'sub_opd';

    protected $queryString = ['periode' => ['except' => '']];

    public function render(): View
    {
        $opds = collect();
        if(auth()->user()->isAdmin()){
            $opds = $this->subOpds(1, $this->dataType);
        } elseif(auth()->user()->isSubOpd()){
            $opds = $this->subOpds(auth()->user()->role->imageable_id);
        }

        [$targetOpds, $colspanRealisasi, $foreachCount] = [Target::all(), $this->colspanRealisasi($this->periode), $this->foreachCount($this->periode)];

        return view('livewire.table-dashboard', compact('opds', 'targetOpds', 'colspanRealisasi', 'foreachCount'));
    }
}
