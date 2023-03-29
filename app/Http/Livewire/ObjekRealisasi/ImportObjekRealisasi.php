<?php

namespace App\Http\Livewire\ObjekRealisasi;

use App\Jobs\ImportObjekRealisasi as JobImportObjekRealisasi;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportObjekRealisasi extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public $file;
    public $tanggal;
    public $hideButton;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
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
           'tanggal' => 'required|date',
           'file' => 'required|mimes:xls,xlsx|max:2048',
        ];
    }

    public function upload()
    {
        $this->validate();

        $idTahapanApbd = Cookie::get('TAID');

        $realisasiRows = SimpleExcelReader::create($this->file->path())
            ->headerOnRow(1)
            ->getRows();

        $chunks = array_chunk(json_decode($realisasiRows), 500);
        $jobs = [];

        foreach ($chunks as $objekRealisasiChunk) {
            array_push($jobs, new JobImportObjekRealisasi($objekRealisasiChunk, $idTahapanApbd, $this->tanggal));
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
