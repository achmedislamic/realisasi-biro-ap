<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Jobs\ImportObjekRealisasi as JobImportObjekRealisasi;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\Bus;
use Illuminate\View\View;
use Livewire\{Component, WithFileUploads};
use Spatie\SimpleExcel\SimpleExcelReader;

final class ImportObjekRealisasi extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public $file;

    public $hideButton;

    public function mount(): void
    {
        $this->hideButton = false;
    }

    protected $listeners = ['importSelesai' => 'showButton'];

    public function showButton(): void
    {
        $this->hideButton = false;
    }

    protected function rules(): array
    {
        return [
            'file' => 'required|mimes:xls,xlsx|max:2048',
        ];
    }

    public function upload(): void
    {
        $this->validate();

        $realisasiRows = SimpleExcelReader::create($this->file->path())
            ->headerOnRow(1)
            ->getRows();

        $chunks = array_chunk(json_decode($realisasiRows, true), 500);
        $jobs = [];

        foreach ($chunks as $objekRealisasiChunk) {
            array_push($jobs, new JobImportObjekRealisasi($objekRealisasiChunk, cache('tahapanApbd')->id));
        }

        $batch = Bus::batch($jobs)->name('Import Anggaran Objek Realisasi')->dispatch();
        $this->emit('showImportProgressEvent', $batch->id);

        $this->hideButton = true;
    }

    public function render(): View
    {
        return view('livewire.objek-realisasi.import-objek-realisasi');
    }
}
