<?php

namespace App\Jobs;

use App\Models\{AkunBelanja, BidangUrusan, BidangUrusanOpd, JenisBelanja, Kegiatan, KelompokBelanja, ObjekBelanja, ObjekRealisasi, Opd, Program, RincianObjekBelanja, SubKegiatan, SubOpd, SubRincianObjekBelanja, Urusan};
use Illuminate\Bus\{Batchable, Queueable};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class ImportObjekRealisasi implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $realisasiChunk;

    private $idTahapanApbd;

    public function __construct($realisasiChunk, $idTahapanApbd)
    {
        $this->realisasiChunk = $realisasiChunk;
        $this->idTahapanApbd = $idTahapanApbd;
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

            $perangkatDaerah = $this->importPerangkatDaerah($item);

            BidangUrusanOpd::firstOrCreate([
                'bidang_urusan_id' => $perangkatDaerah['idBidangUrusan'],
                'opd_id' => $perangkatDaerah['idOpd'],
            ]);

            $programKegiatan = $this->importProgramKegiatan($item);

            $rekeningBelanja = $this->importRekeningBelanja($item);

            ObjekRealisasi::updateOrCreate(
                [
                    'sub_opd_id' => $perangkatDaerah['idSubOpd'],
                    'sub_kegiatan_id' => $programKegiatan['idSubKegiatan'],
                    'sub_rincian_objek_id' => $rekeningBelanja['idSubRincianObjekBelanja'],
                ],
                [
                    'anggaran' => floatval($item['APBD']),
                    'tahapan_apbd_id' => intval($this->idTahapanApbd),
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
            'idSubOpd' => $subOpd->id,
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
