<?php

namespace App\Http\Livewire\Pekerjaan;

use App\Models\{AkunBelanja, BidangUrusan, BidangUrusanOpd, JenisBelanja, Kegiatan, KelompokBelanja, ObjekBelanja, Opd, Pekerjaan, Program, Realisasi, RincianObjekBelanja, SubKegiatan, SubOpd, SubRincianObjekBelanja, TahapanApbd, Urusan};
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\{DB, Storage};
use Livewire\{Component, WithFileUploads};
use Spatie\SimpleExcel\SimpleExcelReader;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UploadExcel extends Component
{
    use WithLiveValidation;
    use WithFileUploads;

    public Pekerjaan $pekerjaan;

    public $file;

    private $rows;

    public $totalRows = 0;

    public $tahapan;

    public $uploadingStatus = false;

    public function mount()
    {
        $this->tahapan = TahapanApbd::first();
    }

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
        $this->rows = SimpleExcelReader::create($this->file->path())->getRows();

        $this->rows->each(function (array $item) {
            $data[] = [
                'kode' => str($item['Urusan'])->before(' '),
                'nama' => str($item['Urusan'])->after(' ')->limit(255),
            ];
        });

        DB::transaction(function () {
            $this->rows->each(function (array $item) {
                $perangkatDaerah = $this->importPerangkatDaerah($item);

                $bidangUrusanOpd = BidangUrusanOpd::firstOrCreate([
                    'bidang_urusan_id' => $perangkatDaerah['idBidangUrusan'],
                    'opd_id' => $perangkatDaerah['idOpd'],
                ]);

                $programKegiatan = $this->importProgramKegiatan($item);
                $rekeningBelanja = $this->importRekeningBelanja($item);

                $realisasi = Realisasi::updateOrCreate(
                    [
                        'tahapan_apbd_id' => $this->tahapan->id,
                        'sub_opd_id' => $perangkatDaerah['idSubOpd'],
                        'sub_kegiatan_id' => $programKegiatan['idSubKegiatan'],
                        'sub_rincian_objek_id' => $rekeningBelanja['idSubRincianObjekBelanja'],
                        'tanggal' => today(),
                    ],
                    [
                        'anggaran' => floatval($item['APBD']),
                        'realisasi' => 0,
                    ]
                );
            });
        });

        return to_route('pekerjaan');
    }

    public function importPerangkatDaerah(array $item): array
    {
        $urusan = Urusan::firstOrCreate([
            'kode' => str($item['Urusan'])->before(' '),
            'nama' => str($item['Urusan'])->after(' ')->limit(255),
        ]);

        $bidangUrusan = BidangUrusan::firstOrCreate([
            'urusan_id' => $urusan->id,
            'kode' => str($item['Bidang Urusan'])->before(' '),
            'nama' => str($item['Bidang Urusan'])->after(' ')->limit(255),
        ]);

        $opd = Opd::firstOrCreate([
            'kode' => str($item['OPD'])->before(' '),
            'nama' => str($item['OPD'])->after(' ')->limit(255),
        ]);

        $subOpd = SubOpd::firstOrCreate([
            'opd_id' => $opd->id,
            'kode' => str($item['Sub Unit'])->before(' '),
            'nama' => str($item['Sub Unit'])->after(' ')->limit(255),
        ]);

        return [
            'idBidangUrusan' => $bidangUrusan->id,
            'idOpd' => $opd->id,
            'idSubOpd' => $subOpd->id,
        ];
    }

    public function importProgramKegiatan(array $item)
    {
        $program = Program::firstOrCreate([
            'kode' => str($item['Program'])->before(' '),
            'nama' => str($item['Program'])->after(' ')->limit(255),
        ]);

        $kegiatan = Kegiatan::firstOrCreate([
            'program_id' => $program->id,
            'kode' => str($item['Kegiatan'])->before(' '),
            'nama' => str($item['Kegiatan'])->after(' ')->limit(255),
        ]);

        $subKegiatan = SubKegiatan::firstOrCreate([
            'kegiatan_id' => $kegiatan->id,
            'kode' => str($item['Sub Kegiatan'])->before(' '),
            'nama' => str($item['Sub Kegiatan'])->after(' ')->limit(255),
        ]);

        return ['idSubKegiatan' => $subKegiatan->id];
    }

    public function importRekeningBelanja(array $item)
    {
        $akunBelanja = AkunBelanja::firstOrCreate([
            'kode' => str($item['Akun'])->before(' '),
            'nama' => str($item['Akun'])->after(' ')->limit(255),
        ]);

        $kelompokBelanja = KelompokBelanja::firstOrCreate([
            'akun_belanja_id' => $akunBelanja->id,
            'kode' => str($item['Kelompok'])->before(' '),
            'nama' => str($item['Kelompok'])->after(' ')->limit(255),
        ]);

        $jenisBelanja = JenisBelanja::firstOrCreate([
            'kelompok_belanja_id' => $kelompokBelanja->id,
            'kode' => str($item['Jenis'])->before(' '),
            'nama' => str($item['Jenis'])->after(' ')->limit(255),
        ]);

        $objekBelanja = ObjekBelanja::firstOrCreate([
            'jenis_belanja_id' => $jenisBelanja->id,
            'kode' => str($item['Objek'])->before(' '),
            'nama' => str($item['Objek'])->after(' ')->limit(255),
        ]);

        $rincianObjekBelanja = RincianObjekBelanja::firstOrCreate([
            'objek_belanja_id' => $objekBelanja->id,
            'kode' => str($item['Rincian Obyek'])->before(' '),
            'nama' => str($item['Rincian Obyek'])->after(' ')->limit(255),
        ]);

        $subRincianObjekBelanja = SubRincianObjekBelanja::firstOrCreate([
            'rincian_objek_belanja_id' => $rincianObjekBelanja->id,
            'kode' => str($item['Rekening (Sub Rincian Obyek)'])->before(' '),
            'nama' => str($item['Rekening (Sub Rincian Obyek)'])->after(' ')->limit(255),
        ]);

        return ['idSubRincianObjekBelanja' => $subRincianObjekBelanja->id];
    }

    public function render()
    {
        $total = $this->totalRows;

        return view('livewire.pekerjaan.upload-excel', compact('total'));
    }
}
