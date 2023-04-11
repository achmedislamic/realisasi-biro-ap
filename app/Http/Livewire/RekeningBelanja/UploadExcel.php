<?php

namespace App\Http\Livewire\RekeningBelanja;

use App\Models\RekeningBelanja;
use App\Traits\WithLiveValidation;
use Livewire\{Component, WithFileUploads};
use Spatie\SimpleExcel\SimpleExcelReader;

class UploadExcel extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public RekeningBelanja $rekening;

    public $file;

    protected function rules(): array
    {
        return [
            'file' => 'required|mimes:xls,xlsx,csv|max:2048',
        ];
    }

    public function upload()
    {
        $this->validate();
        $rows = SimpleExcelReader::create($this->file->path())->getRows();

        $rows->each(function (array $rowProperties) {
            RekeningBelanja::create([
                'kode' => $rowProperties['kode'],
                'nama' => $rowProperties['nama'],
            ]);
        });

        return to_route('rekening-belanja');
    }

    public function render()
    {
        return view('livewire.rekening-belanja.upload-excel');
    }
}
