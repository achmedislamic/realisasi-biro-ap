<?php

namespace App\Http\Livewire;

use App\Models\{Opd, SubOpd, Target};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

final class TargetForm extends Component
{
    public $subOpd;

    public $targets;

    public function mount(int $subOpdId)
    {
        $this->subOpd = SubOpd::findOrFail($subOpdId);

        $this->targets = [];

        for ($i = 1; $i <= 12; $i++) {
            array_push($this->targets, Target::select('jumlah')->where('targetable_id', $subOpdId)->where('bulan', $i)->first()->jumlah ?? 0);
        }
    }

    private function bulans(): array
    {
        return ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }

    protected function rules(): array
    {
        return [
            'targets.*' => 'nullable|numeric',
        ];
    }

    public function simpan()
    {
        $this->validate();

        DB::transaction(function () {
            $i = 0;
            foreach ($this->targets as $target) {
                Target::updateOrCreate([
                    'tahun' => cache('tahapanApbd')->tahun,
                    'bulan' => ++$i,
                    'targetable_id' => $this->subOpd->id,
                    'targetable_type' => 'sub_opd',
                ], ['jumlah' => $target]);
            }
        });

        return to_route('target');
    }

    public function render(): View
    {
        return view('livewire.target-form', [
            'bulans' => $this->bulans(),
        ]);
    }
}
