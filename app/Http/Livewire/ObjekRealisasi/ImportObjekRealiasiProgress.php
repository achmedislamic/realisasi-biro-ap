<?php

namespace App\Http\Livewire\ObjekRealisasi;

use Illuminate\Support\Facades\Bus;
use Livewire\Component;

class ImportObjekRealiasiProgress extends Component
{
    public $showImportProgress = false;
    public $importFinished = false;
    public $idBatch = "";

    protected $listeners = ['showImportProgressEvent' => 'showProgress'];

    public function showProgress($idBatch = "")
    {
        if ($idBatch) {
            $this->idBatch = $idBatch;
            $this->showImportProgress = true;
            $this->importFinished = false;
        }
    }

    public function render()
    {
        $percentage = 0;
        if ($this->idBatch) {
            $batch = Bus::findBatch($this->idBatch);
            $percentage = $batch->progress();

            if ($percentage == 100) {
                $this->idBatch = "";
                $this->showImportProgress = false;
                $this->importFinished = true;
                $this->emit('importSelesai');
            }
        }

        return view('livewire.objek-realisasi.import-objek-realiasi-progress', compact('percentage'));
    }
}
