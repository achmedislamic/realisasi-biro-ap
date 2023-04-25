<?php

namespace App\Http\Livewire;

use App\Models\{Opd, SubOpd, Target};
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TargetForm extends Component
{
    public $opd;

    public $targets;

    public $mode;

    public function mount(int $opd, string $mode = null)
    {
        $this->mode = $mode;
        if (is_null($mode)) {
            $this->opd = Opd::find($opd);
        } else {
            $this->opd = SubOpd::find($opd);
        }

        $this->targets = [];

        for($i = 1; $i <= 12; $i++)
        {
            array_push($this->targets, Target::select('jumlah')->where('targetable_id', $opd)->where('bulan', $i)->first()->jumlah ?? 0);
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
                if (filled($target) && $target != 0) {
                    $target = Target::updateOrCreate([
                        'tahun' => cache('tahapanApbd')->tahun,
                        'bulan' => ++$i,
                        'targetable_id' => $this->opd->id,
                        'targetable_type' => is_null($this->mode) ? 'opd' : 'sub_opd',
                    ], ['jumlah' => $target]);
                }
            }
        });

        return to_route('target');
    }

    public function render()
    {
        return view('livewire.target-form', [
            'bulans' => $this->bulans(),
        ]);
    }
}
