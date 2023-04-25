<?php

namespace App\Http\Livewire;

use App\Models\{Opd, SubOpd};
use Livewire\Component;

class TargetTable extends Component
{
    public function render()
    {
        $opds = Opd::query()
            ->with('targets')
            ->get();

        $biros = SubOpd::query()
            ->whereRelation('opd', 'nama', 'like', '%sekretariat daerah%')
            ->with('targets')
            ->get();

        return view('livewire.target-table', compact('opds', 'biros'));
    }
}
