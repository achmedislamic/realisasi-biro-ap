<?php

namespace App\Http\Livewire\Realisasi;

use App\Jobs\ImportRealisasi as JobsImportRealisasi;
use App\Models\TahapanApbd;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportRealisasi extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public $file;
    public $idTahapanApbd;
    public $tanggal;
    public $tahapanApbds;
    public $hideButton;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
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
           'idTahapanApbd' => 'required',
           'tanggal' => 'required|date',
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

        foreach ($chunks as $realisasiChunk) {
            array_push($jobs, new JobsImportRealisasi($realisasiChunk, $this->idTahapanApbd, $this->tanggal));
        }

        $batch = Bus::batch($jobs)->name('Import Anggaran Realisasi')->dispatch();
        $this->emit('showImportProgressEvent', $batch->id);
        $this->hideButton = true;
    }

    public function render()
    {
        return view('livewire.realisasi.import-realisasi');
    }
}
