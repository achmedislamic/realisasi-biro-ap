<?php

namespace App\Http\Livewire\Realisasi;

use App\Models\AkunBelanja;
use App\Models\BidangUrusan;
use App\Models\BidangUrusanOpd;
use App\Models\JenisBelanja;
use App\Models\Kegiatan;
use App\Models\KelompokBelanja;
use App\Models\ObjekBelanja;
use App\Models\Opd;
use App\Models\Program;
use App\Models\Realisasi;
use App\Models\RincianObjekBelanja;
use App\Models\SubKegiatan;
use App\Models\SubOpd;
use App\Models\SubRincianObjekBelanja;
use App\Models\TahapanApbd;
use App\Models\Urusan;
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\DB;
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

        $realisasiRows->each(function (array $item) {
            $perangkatDaerah = $this->importPerangkatDaerah($item);

            /**
             * Import bidang urusan OPD
             */
            BidangUrusanOpd::firstOrCreate([
                'bidang_urusan_id' => $perangkatDaerah['idBidangUrusan'],
                'opd_id' => $perangkatDaerah['idOpd'],
            ]);

            /**
             * Import Program, Kegiatan, Sub Kegiatan
             */
            $programKegiatan = $this->importProgramKegiatan($item);

            /**
             * Import Rekening Belanja Akun s/d Sub Rincian Objek Belanja
             */
            $rekeningBelanja = $this->importRekeningBelanja($item);

            /**
             * Import Realisasi
             */
            $realisasi = Realisasi::updateOrCreate(
                [
                    'tahapan_apbd_id' => intval($this->idTahapanApbd),
                    'sub_opd_id' => $perangkatDaerah['idSubOpd'],
                    'sub_kegiatan_id' => $programKegiatan['idSubKegiatan'],
                    'sub_rincian_objek_id' => $rekeningBelanja['idSubRincianObjekBelanja'],
                    'tanggal' => $this->tanggal
                ],
                [
                    'anggaran' => floatval($item['APBD']),
                    'realisasi' => floatval($item['REALISASI'])
                ]
            );
        });

        return redirect()->to('/realisasi');
    }

    public function importPerangkatDaerah(array $item)
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
            'idSubOpd' => $subOpd->id
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
        return view('livewire.realisasi.import-realisasi');
    }
}
