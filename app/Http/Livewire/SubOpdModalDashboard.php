<?php

namespace App\Http\Livewire;

use App\Models\Target;
use App\Traits\PerhitunganAnggaranRealisasiDashboard;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class SubOpdModalDashboard extends Component
{
    use PerhitunganAnggaranRealisasiDashboard;

    public $modal = false;

    public $opdId = null;

    public string $periode = '';

    protected $listeners = ['opdDashboardClicked'];

    public function opdDashboardClicked($opdId, $periode): void
    {
        $this->modal = true;
        $this->opdId = $opdId;
        $this->periode = $periode;
    }

    public function render(): View
    {
        return view('livewire.sub-opd-modal-dashboard', [
            'subOpds' => $this->subOpds($this->opdId),
            'colspanRealisasi' => $this->colspanRealisasi($this->periode, denganTarget: false),
            'foreachCount' => $this->foreachCount($this->periode),
            'targetSubOpds' => Target::where('targetable_type', 'sub_opd')->get(),
        ]);
    }
}
