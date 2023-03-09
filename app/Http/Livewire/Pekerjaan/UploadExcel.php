<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\BidangUrusan;
use App\Models\BidangUrusanOpd;
use App\Models\Opd;
use App\Models\Pekerjaan;
use App\Models\SubOpd;
use App\Models\Urusan;
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

        $rows->each(function (array $item) {
            $urusan = Urusan::firstOrCreate([
                'kode' => str($item['Urusan'])->before(' '),
                'nama' => str($item['Urusan'])->after(' ')
            ]);

            $bidangUrusan = BidangUrusan::firstOrCreate([
                'urusan_id' => $urusan->id,
                'kode' => str($item['Bidang Urusan'])->before(' '),
                'nama' => str($item['Bidang Urusan'])->after(' '),
            ]);

            $opd = Opd::firstOrCreate([
                'kode' => str($item['OPD'])->before(' '),
                'nama' => str($item['OPD'])->after(' '),
            ]);

            $subOpd = SubOpd::firstOrCreate([
                'opd_id' => $opd->id,
                'kode' => str($item['Sub Unit'])->before(' '),
                'nama' => str($item['Sub Unit'])->after(' '),
            ]);

            $bidangUrusanOpd = BidangUrusanOpd::firstOrCreate([
                'bidang_urusan_id' => $bidangUrusan->id,
                'opd_id' => $opd->id,
            ]);

            // dd($item);
            // if ($item["aksi"] === "hapus") {
            //     Pekerjaan::where("nama", $item["nama"])->delete();
            // } else {
            //     Pekerjaan::updateOrCreate(
            //         ["nama" => $item["nama"]],
            //         [
            //             "volume" => $item["volume"],
            //             "satuan" => $item["satuan"]
            //             ]
            //     );
            // }
        });

        return to_route('pekerjaan');
    }

    public function render()
    {
        return view('livewire.pekerjaan.upload-excel');
    }
}
