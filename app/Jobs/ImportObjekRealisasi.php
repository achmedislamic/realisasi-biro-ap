<?php

namespace App\Jobs;

use App\Models\BidangUrusanSubOpd;
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

    public function __construct(private $realisasiChunk, private $idTahapanApbd) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->realisasiChunk as $item) {
            ObjekRealisasi::updateOrCreate(
                [
                    'sub_opd_id' => $this->importPerangkatDaerah($item),
                    'sub_kegiatan_id' => $this->importProgramKegiatan($item),
                    'sub_rincian_objek_id' => $this->importRekeningBelanja($item),
                ],
                [
                    'anggaran' => floatval($item['APBD']),
                    'tahapan_apbd_id' => intval($this->idTahapanApbd),
                ]
            );
        }
    }

    private function importPerangkatDaerah(array $item): int
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

        BidangUrusanSubOpd::firstOrCreate([
            'bidang_urusan_id' => $bidangUrusan->id,
            'sub_opd_id' => $subOpd->id,
        ]);

        return $subOpd->id;
    }

    private function importProgramKegiatan(array $item): int
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

        return SubKegiatan::firstOrCreate([
            'kegiatan_id' => $kegiatan->id,
            'kode' => str($item['Sub Kegiatan'])->before(' '),
            'nama' => str($item['Sub Kegiatan'])->after(' ')->limit(250),
        ])->id;
    }

    private function importRekeningBelanja(array $item): int
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

        return SubRincianObjekBelanja::firstOrCreate([
            'rincian_objek_belanja_id' => $rincianObjekBelanja->id,
            'kode' => str($item['Rekening (Sub Rincian Obyek)'])->before(' '),
            'nama' => str($item['Rekening (Sub Rincian Obyek)'])->after(' ')->limit(250),
        ])->id;
    }
}
