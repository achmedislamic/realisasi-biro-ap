<?php

namespace App\Jobs;

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
use App\Models\Urusan;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportRealisasi implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $realisasiChunk;
    private $idTahapanApbd;
    private $tanggal;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $realisasiChunk,
        $idTahapanApbd,
        $tanggal
    ) {
        $this->realisasiChunk = $realisasiChunk;
        $this->idTahapanApbd = $idTahapanApbd;
        $this->tanggal = $tanggal;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        usleep(50000);

        foreach ($this->realisasiChunk as $item) {
            $item = (array) $item;
            /**
            * Import bidang OPD
            */
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
            Realisasi::updateOrCreate(
                [
                    'tahapan_apbd_id' => intval($this->idTahapanApbd),
                    'sub_opd_id' => $perangkatDaerah['idSubOpd'],
                    'sub_kegiatan_id' => $programKegiatan['idSubKegiatan'],
                    'sub_rincian_objek_id' => $rekeningBelanja['idSubRincianObjekBelanja'],
                    'tanggal' => $this->tanggal
                ],
                [
                    'anggaran' => floatval($item['APBD']),
                    'realisasi' => 0
                ]
            );
        }
    }

    public function importPerangkatDaerah(array $item)
    {
        $urusan = Urusan::firstOrCreate([
            'kode' => str($item['Urusan'])->before(' '),
            'nama' => str($item['Urusan'])->after(' ')->limit(250),
        ]);

        $bidangUrusan = BidangUrusan::firstOrCreate([
            'urusan_id' => $urusan->id,
            'kode' => str($item['Bidang Urusan'])->before(' '),
            'nama' => str($item['Bidang Urusan'])->after(' ')->limit(250),
        ]);

        $opd = Opd::firstOrCreate([
            'kode' => str($item['OPD'])->before(' '),
            'nama' => str($item['OPD'])->after(' ')->limit(250),
        ]);

        $subOpd = SubOpd::firstOrCreate([
            'opd_id' => $opd->id,
            'kode' => str($item['Sub Unit'])->before(' '),
            'nama' => str($item['Sub Unit'])->after(' ')->limit(250),
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
            'nama' => str($item['Program'])->after(' ')->limit(250),
        ]);

        $kegiatan = Kegiatan::firstOrCreate([
            'program_id' => $program->id,
            'kode' => str($item['Kegiatan'])->before(' '),
            'nama' => str($item['Kegiatan'])->after(' ')->limit(250),
        ]);

        $subKegiatan = SubKegiatan::firstOrCreate([
            'kegiatan_id' => $kegiatan->id,
            'kode' => str($item['Sub Kegiatan'])->before(' '),
            'nama' => str($item['Sub Kegiatan'])->after(' ')->limit(250),
        ]);

        return ['idSubKegiatan' => $subKegiatan->id];
    }

    public function importRekeningBelanja(array $item)
    {
        $akunBelanja = AkunBelanja::firstOrCreate([
            'kode' => str($item['Akun'])->before(' '),
            'nama' => str($item['Akun'])->after(' ')->limit(250),
        ]);

        $kelompokBelanja = KelompokBelanja::firstOrCreate([
            'akun_belanja_id' => $akunBelanja->id,
            'kode' => str($item['Kelompok'])->before(' '),
            'nama' => str($item['Kelompok'])->after(' ')->limit(250),
        ]);

        $jenisBelanja = JenisBelanja::firstOrCreate([
            'kelompok_belanja_id' => $kelompokBelanja->id,
            'kode' => str($item['Jenis'])->before(' '),
            'nama' => str($item['Jenis'])->after(' ')->limit(250),
        ]);

        $objekBelanja = ObjekBelanja::firstOrCreate([
            'jenis_belanja_id' => $jenisBelanja->id,
            'kode' => str($item['Objek'])->before(' '),
            'nama' => str($item['Objek'])->after(' ')->limit(250),
        ]);

        $rincianObjekBelanja = RincianObjekBelanja::firstOrCreate([
            'objek_belanja_id' => $objekBelanja->id,
            'kode' => str($item['Rincian Obyek'])->before(' '),
            'nama' => str($item['Rincian Obyek'])->after(' ')->limit(250),
        ]);


        $subRincianObjekBelanja = SubRincianObjekBelanja::firstOrCreate([
            'rincian_objek_belanja_id' => $rincianObjekBelanja->id,
            'kode' => str($item['Rekening (Sub Rincian Obyek)'])->before(' '),
            'nama' => str($item['Rekening (Sub Rincian Obyek)'])->after(' ')->limit(250),
        ]);

        return ['idSubRincianObjekBelanja' => $subRincianObjekBelanja->id];
    }
}
