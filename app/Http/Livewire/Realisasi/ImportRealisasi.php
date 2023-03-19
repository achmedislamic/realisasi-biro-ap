<?php

namespace App\Http\Livewire\Realisasi;

use App\Jobs\ImportRealisasi as JobsImportRealisasi;
use App\Models\TahapanApbd;
use App\Traits\WithLiveValidation;
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

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->tahapanApbds = TahapanApbd::orderByDesc('tahun')->get();
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

        foreach ($chunks as $realisasiChunk) {
            JobsImportRealisasi::dispatch($realisasiChunk, $this->idTahapanApbd, $this->tanggal);
        }

        dd(count($chunks));

        // return redirect()->to('/realisasi');
    }

    public function render()
    {
        return view('livewire.realisasi.import-realisasi');
    }
}
