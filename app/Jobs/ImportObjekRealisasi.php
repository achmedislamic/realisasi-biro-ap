<?php

namespace App\Jobs;

use App\Models\BidangUrusanSubOpd;
use App\Models\{AkunBelanja, BidangUrusan, JenisBelanja, Kegiatan, KelompokBelanja, ObjekBelanja, ObjekRealisasi, Opd, Program, RincianObjekBelanja, SubKegiatan, SubOpd, SubRincianObjekBelanja, Urusan};
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

    public function __construct(private $realisasiChunk, private $idTahapanApbd)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->realisasiChunk as $item) {
            $urusan = Urusan::firstOrCreate([
                'kode' => str($item['Urusan'])->before(' '),
                'nama' => str($item['Urusan'])->after(' ')->limit(250),
            ]);

            $bidangUrusan = BidangUrusan::firstOrCreate([
                'urusan_id' => $urusan->id,
                'kode' => str($item['Bidang Urusan'])->before(' ')->after($urusan->kode.'.'),
                'nama' => str($item['Bidang Urusan'])->after(' '),
            ]);

            $opd = Opd::firstOrCreate([
                'kode' => str($item['OPD'])->before(' ')->before('.0000'),
                'nama' => str($item['OPD'])->after(' '),
            ]);

            $subOpd = SubOpd::firstOrCreate([
                'opd_id' => $opd->id,
                'kode' => str($item['Sub Unit'])->before(' ')->after($opd->kode.'.'),
                'nama' => str($item['Sub Unit'])->after(' '),
            ]);

            $bidangUrusanSubOpd = BidangUrusanSubOpd::firstOrCreate([
                'bidang_urusan_id' => $bidangUrusan->id,
                'sub_opd_id' => $subOpd->id,
            ]);

            $program = Program::firstOrCreate([
                'kode' => str($item['Program'])->before(' ')->after($urusan->kode.'.'.$bidangUrusan->kode.'.'),
                'nama' => str($item['Program'])->after(' '),
            ]);

            $kegiatan = Kegiatan::firstOrCreate([
                'program_id' => $program->id,
                'kode' => str($item['Kegiatan'])->before(' ')->after($urusan->kode.'.'.$bidangUrusan->kode.'.'.$program->kode.'.'),
                'nama' => str($item['Kegiatan'])->after(' '),
            ]);

            $subKegiatan = SubKegiatan::firstOrCreate([
                'kegiatan_id' => $kegiatan->id,
                'kode' => str($item['Sub Kegiatan'])->before(' ')->after($urusan->kode.'.'.$bidangUrusan->kode.'.'.$program->kode.'.'.$kegiatan->kode.'.'),
                'nama' => str($item['Sub Kegiatan'])->after(' '),
            ]);

            $akunBelanja = AkunBelanja::firstOrCreate([
                'kode' => str($item['Akun'])->before(' '),
                'nama' => str($item['Akun'])->after(' '),
            ]);

            $kelompokBelanja = KelompokBelanja::firstOrCreate([
                'akun_belanja_id' => $akunBelanja->id,
                'kode' => str($item['Kelompok'])->before(' ')->after($akunBelanja->kode),
                'nama' => str($item['Kelompok'])->after(' '),
            ]);

            $jenisBelanja = JenisBelanja::firstOrCreate([
                'kelompok_belanja_id' => $kelompokBelanja->id,
                'kode' => str($item['Jenis'])->before(' ')->after($akunBelanja->kode.$kelompokBelanja->kode.'.'),
                'nama' => str($item['Jenis'])->after(' '),
            ]);

            $objekBelanja = ObjekBelanja::firstOrCreate([
                'jenis_belanja_id' => $jenisBelanja->id,
                'kode' => str($item['Objek'])->before(' ')->after($akunBelanja->kode.$kelompokBelanja->kode.'.'.$jenisBelanja->kode.'.'),
                'nama' => str($item['Objek'])->after(' '),
            ]);

            $rincianObjekBelanja = RincianObjekBelanja::firstOrCreate([
                'objek_belanja_id' => $objekBelanja->id,
                'kode' => str($item['Rincian Obyek'])->before(' ')->after($akunBelanja->kode.$kelompokBelanja->kode.'.'.$jenisBelanja->kode.'.'.$objekBelanja->kode.'.'),
                'nama' => str($item['Rincian Obyek'])->after(' '),
            ]);

            $subRincianObjekBelanja = SubRincianObjekBelanja::firstOrCreate([
                'rincian_objek_belanja_id' => $rincianObjekBelanja->id,
                'kode' => str($item['Rekening (Sub Rincian Obyek)'])->before(' ')->after($akunBelanja->kode.$kelompokBelanja->kode.'.'.$jenisBelanja->kode.'.'.$objekBelanja->kode.'.'.$rincianObjekBelanja->kode.'.'),
                'nama' => str($item['Rekening (Sub Rincian Obyek)'])->after(' '),
            ]);

            if (! is_null($bidangUrusanSubOpd->id) && ! is_null($subKegiatan->id) && ! is_null($subRincianObjekBelanja->id)) {
                ObjekRealisasi::updateOrCreate(
                    [
                        'bidang_urusan_sub_opd_id' => $bidangUrusanSubOpd->id,
                        'sub_kegiatan_id' => $subKegiatan->id,
                        'sub_rincian_objek_belanja_id' => $subRincianObjekBelanja->id,
                    ],
                    [
                        'anggaran' => floatval($item['APBD']),
                        'tahapan_apbd_id' => intval($this->idTahapanApbd),
                    ]
                );
            }
        }
    }
}
