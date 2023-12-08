<?php

namespace App\Http\Livewire;

use App\Models\Bidang;
use App\Models\{Opd, SubOpd};
use Livewire\Component;

final class TargetTable extends Component
{
    public function render()
    {
        $subOpds = SubOpd::query()
            ->where('opd_id', 1)
            ->with('targets')
            ->get();

        $bidangs = Bidang::query()
            ->with('targets')
            ->orderBy('nama')
            ->get();

        return view('livewire.target-table', compact('subOpds', 'bidangs'));
    }
}
