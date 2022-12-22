<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\Pekerjaan;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UploadExcel extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public Pekerjaan $pekerjaan;
    public $file;

    protected function rules(): array
    {
        return [
           'file' => 'required|mimes:xls,xlsx,csv|max:2048',
        ];
    }

    public function downloadTemplate(): StreamedResponse
    {
        return Storage::download('upload-template/upload pekerjaan.xlsx');
    }

    public function upload()
    {
        $this->validate();
        $rows = SimpleExcelReader::create($this->file->path())->getRows();

        $rows->each(function (array $rowProperties) {
            if ($rowProperties["aksi"] === "hapus") {
                Pekerjaan::where("nama", $rowProperties["nama"])->delete();
            } else {
                Pekerjaan::updateOrCreate(
                    ["nama" => $rowProperties["nama"]],
                    [
                        "volume" => $rowProperties["volume"],
                        "satuan" => $rowProperties["satuan"]
                        ]
                );
            }
        });

        return to_route('pekerjaan');
    }

    public function render()
    {
        return view('livewire.pekerjaan.upload-excel');
    }
}
