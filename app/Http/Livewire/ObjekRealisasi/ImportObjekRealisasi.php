<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Jobs\ImportObjekRealisasi as JobImportObjekRealisasi;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\Bus;
use Livewire\{Component, WithFileUploads};
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportObjekRealisasi extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public $file;

    public $hideButton;

    public function mount()
    {
        $this->hideButton = false;
    }

    protected $listeners = ['importSelesai' => 'showButton'];

    public function showButton()
    {
        $this->hideButton = false;
    }

    protected function rules(): array
    {
        return [
            'file' => 'required|mimes:xls,xlsx|max:2048',
        ];
    }

    public function upload()
    {
        $this->validate();

        $realisasiRows = SimpleExcelReader::create($this->file->path())
            ->headerOnRow(1)
            ->getRows();

        $chunks = array_chunk(json_decode($realisasiRows), 500);
        $jobs = [];

        foreach ($chunks as $objekRealisasiChunk) {
            array_push($jobs, new JobImportObjekRealisasi($objekRealisasiChunk, cache('tahapanApbd')->id));
        }

        $batch = Bus::batch($jobs)->name('Import Anggaran Objek Realisasi')->dispatch();
        $this->emit('showImportProgressEvent', $batch->id);

        $this->hideButton = true;
    }

    public function render()
    {
        return view('livewire.objek-realisasi.import-objek-realisasi');
    }
}
