<table style="font-family: Arial, Helvetica, sans-serif;">
    <tbody>
        <tr>
            <td colspan="14" style="text-align: right;">FORM. A</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="14" style="text-align: center;">LAPORAN BULANAN PELAKSANAAN PROGRAM/KEGIATAN/SUBKEGIATAN</td>
        </tr>
        <tr>
            <td colspan="14" style="text-align: center;">DOKUMEN PELAKSANAAN ANGGARAN APBD PROVINSI NTB</td>
        </tr>
        <tr>
            <td colspan="14" style="text-align: center;">TAHUN ANGGARAN {{ cache('tahapanApbd')->tahun }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nama Urusan</td>
            <td>: {{ $namaUrusan }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Organisasi</td>
            <td>
                {{ filled($namaSubOpd) ? $namaOpd . ' - ' . $namaSubOpd : $namaOpd }}
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>: Bulan {{ $namaBulan }} {{ cache('tahapanApbd')->tahun }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="text-align: center; vertical-align: center;">
            <td rowspan="4" style="border:1px solid black;padding:5px">No</td>
            <td rowspan="4" style="border:1px solid black;padding:5px">Nama Program/Kegiatan/Subkegiatan</td>
            <td rowspan="4" style="border:1px solid black;padding:5px">Jumlah Anggaran (Rp)</td>
            <td rowspan="4" style="border:1px solid black;padding:5px">Bobot (%)</td>
            <td colspan="9" style="border:1px solid black;padding:5px">Realisasi Pelaksanaan Anggaran</td>
            <td rowspan="4" style="border:1px solid black;padding:5px">Sisa Anggaran (Rp)</td>
        </tr>
        <tr>
            <td colspan="3" style="border:1px solid black;padding:5px">Bulan Lalu</td>
            <td colspan="3" style="border:1px solid black;padding:5px">Bulan Ini</td>
            <td colspan="3" style="border:1px solid black;padding:5px">s.d. Bulan Ini</td>
        </tr>
        <tr>
            <td colspan="2" style="border:1px solid black;padding:5px">Keuangan</td>
            <td rowspan="2" style="border:1px solid black;padding:5px">Fisik (%)</td>
            <td colspan="2" style="border:1px solid black;padding:5px">Keuangan</td>
            <td rowspan="2" style="border:1px solid black;padding:5px">Fisik (%)</td>
            <td colspan="2" style="border:1px solid black;padding:5px">Keuangan</td>
            <td rowspan="2" style="border:1px solid black;padding:5px">Fisik (%)</td>
        </tr>
        <tr>
            <td style="border:1px solid black;padding:5px">Rp.</td>
            <td style="border:1px solid black;padding:5px">%</td>
            <td style="border:1px solid black;padding:5px">Rp.</td>
            <td style="border:1px solid black;padding:5px">%</td>
            <td style="border:1px solid black;padding:5px">Rp.</td>
            <td style="border:1px solid black;padding:5px">%</td>
        </tr>
        <tr>
            <td style="border:1px solid black;padding:5px">1</td>
            <td style="border:1px solid black;padding:5px">2</td>
            <td style="border:1px solid black;padding:5px">3</td>
            <td style="border:1px solid black;padding:5px">4</td>
            <td style="border:1px solid black;padding:5px">5</td>
            <td style="border:1px solid black;padding:5px">6</td>
            <td style="border:1px solid black;padding:5px">7</td>
            <td style="border:1px solid black;padding:5px">8</td>
            <td style="border:1px solid black;padding:5px">9</td>
            <td style="border:1px solid black;padding:5px">10</td>
            <td style="border:1px solid black;padding:5px">11</td>
            <td style="border:1px solid black;padding:5px">12</td>
            <td style="border:1px solid black;padding:5px">13</td>
            <td style="border:1px solid black;padding:5px">14</td>
        </tr>
        @php
            $belanja1 = null;
            $belanja2 = null;
            $belanja3 = null;
            $belanja4 = null;
            $belanja5 = null;
            $belanja6 = null;
            $program = null;
            $kegiatan = null;
            $subKegiatan = null;
            $i = 1;
        @endphp
        @foreach ($opds as $opd)
            @php
                $queryBelanja1 = $opds->where('nama_belanja_1', $opd->nama_belanja_1);
                $queryBelanja2 = $queryBelanja1->where('nama_belanja_2', $opd->nama_belanja_2);

                $queryProgram = $queryBelanja2->where('nama_program', $opd->nama_program);
                $queryKegiatan = $queryProgram->where('nama_kegiatan', $opd->nama_kegiatan);
                $querySubKegiatan = $queryKegiatan->where('nama_sub_kegiatan', $opd->nama_sub_kegiatan);

                $queryBelanja3 = $querySubKegiatan->where('nama_belanja_3', $opd->nama_belanja_3);
                $queryBelanja4 = $queryBelanja3->where('nama_belanja_4', $opd->nama_belanja_4);
                $queryBelanja5 = $queryBelanja4->where('nama_belanja_5', $opd->nama_belanja_5);
                $queryBelanja6 = $queryBelanja5->where('nama_belanja_6', $opd->nama_belanja_6);
            @endphp
            @if ($belanja1 != $opd->nama_belanja_1)
                <tr>
                    <td style="border:1px solid black;padding:5px; text-align: left;">{{ $opd->kode_belanja_1 }}</td>
                    <td>{{ $opd->nama_belanja_1 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja1->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $belanja1 = $opd->nama_belanja_1;
                    @endphp
                </tr>
            @endif
            @if ($belanja2 != $opd->nama_belanja_2)
                <tr>
                    <td style="border:1px solid black;padding:5px; text-align: left;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 }}</td>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_2 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja2->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $belanja2 = $opd->nama_belanja_2;
                    @endphp
                </tr>
            @endif
            @if ($program != $opd->nama_program)
                <tr>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program }}</td>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->nama_program }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryProgram->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $realisasiBulanLalu = $queryProgram->sum('realisasi_bulan_lalu');
                        $realisasiBulanIni = $queryProgram->sum('realisasi_bulan_ini');
                        $realisasiSdBulanIni = $queryProgram->sum('realisasi_sd_bulan_ini');
                        $anggaran = $queryProgram->sum('anggaran');
                        $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                    @endphp
                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanLalu }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiSdBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $sisaAnggaran }}</td>
                    @php
                        $program = $opd->nama_program;
                    @endphp
                </tr>
            @endif
            @if ($kegiatan != $opd->nama_kegiatan)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' .$opd->kode_kegiatan }}</td>
                    <td style="border:1px solid black;padding:5px">Kegiatan: {{ $opd->nama_kegiatan }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryKegiatan->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $realisasiBulanLalu = $queryKegiatan->sum('realisasi_bulan_lalu');
                        $realisasiBulanIni = $queryKegiatan->sum('realisasi_bulan_ini');
                        $realisasiSdBulanIni = $queryKegiatan->sum('realisasi_sd_bulan_ini');
                        $anggaran = $queryKegiatan->sum('anggaran');
                        $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                    @endphp
                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanLalu }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiSdBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $sisaAnggaran }}</td>
                    @php
                        $kegiatan = $opd->nama_kegiatan;
                    @endphp
                </tr>
            @endif
            @if ($subKegiatan != $opd->nama_sub_kegiatan)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' .$opd->kode_kegiatan . '.' . $opd->kode_sub_kegiatan }}</td>
                    <td style="border:1px solid black;padding:5px">Sub Kegiatan: {{ $opd->nama_sub_kegiatan }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $querySubKegiatan->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $realisasiBulanLalu = $querySubKegiatan->sum('realisasi_bulan_lalu');
                        $realisasiBulanIni = $querySubKegiatan->sum('realisasi_bulan_ini');
                        $realisasiSdBulanIni = $querySubKegiatan->sum('realisasi_sd_bulan_ini');
                        $anggaran = $querySubKegiatan->sum('anggaran');
                        $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                    @endphp
                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanLalu }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiSdBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $sisaAnggaran }}</td>
                    @php
                        $subKegiatan = $opd->nama_sub_kegiatan;
                    @endphp
                </tr>
            @endif
            @if ($belanja3 != $opd->nama_belanja_3)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_belanja_1 .  $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 }}</td>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_3 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja3->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $belanja3 = $opd->nama_belanja_3;
                    @endphp
                </tr>
            @endif
            @if ($belanja4 != $opd->nama_belanja_4)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_belanja_1 .  $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 }}</td>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_4 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja4->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $belanja4 = $opd->nama_belanja_4;
                    @endphp
                </tr>
            @endif
            @if ($belanja5 != $opd->nama_belanja_5)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_belanja_1 .  $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 }}</td>
                    <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_5 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja5->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $belanja5 = $opd->nama_belanja_5;
                    @endphp
                </tr>
            @endif
            @if ($belanja6 != $opd->nama_belanja_6)
                <tr>
                    <td style="border:1px solid black;padding:5px">{{ $opd->kode_belanja_1 .  $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 . '.' . $opd->kode_belanja_6 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $opd->nama_belanja_6 }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $queryBelanja6->sum('anggaran') }}</td>
                    <td style="border:1px solid black;padding:5px"></td>
                    @php
                        $realisasiBulanLalu = $queryBelanja6->sum('realisasi_bulan_lalu');
                        $realisasiBulanIni = $queryBelanja6->sum('realisasi_bulan_ini');
                        $realisasiSdBulanIni = $queryBelanja6->sum('realisasi_sd_bulan_ini');
                        $anggaran = $queryBelanja6->sum('anggaran');
                        $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                    @endphp
                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanLalu }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $realisasiSdBulanIni }}</td>
                    <td style="border:1px solid black;padding:5px">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                    <td style="border:1px solid black;padding:5px"></td>

                    <td style="border:1px solid black;padding:5px">{{ $sisaAnggaran }}</td>
                    @php
                        $subKegiatan = $opd->nama_sub_kegiatan;
                    @endphp
                </tr>
            @endif
            @php
                $i++;
            @endphp
        @endforeach
        <tr>
            <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Jumlah Belanja</td>
            <td style="border:1px solid black;padding:5px">{{ $opds->sum('anggaran') }}</td>
            <td style="border:1px solid black;padding:5px"></td>

            <td style="border:1px solid black;padding:5px">{{ $opds->sum('realisasi_bulan_lalu') }}</td>
            <td style="border:1px solid black;padding:5px"></td>
            <td style="border:1px solid black;padding:5px"></td>

            <td style="border:1px solid black;padding:5px">{{ $opds->sum('realisasi_bulan_ini') }}</td>
            <td style="border:1px solid black;padding:5px"></td>
            <td style="border:1px solid black;padding:5px"></td>

            <td style="border:1px solid black;padding:5px">{{ $opds->sum('realisasi_sd_bulan_ini') }}</td>
            <td style="border:1px solid black;padding:5px"></td>
            <td style="border:1px solid black;padding:5px"></td>
        </tr>

        <tr>
            <td colspan="14"></td>
        </tr>
        <tr>
            <td colspan="14"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">Mataram, {{ \App\Helpers\FormatHelper::tanggal(today()) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">
                @php
                    $teks = 'Kepala Perangkat Daerah';
                    if (filled($namaSubOpd)) {
                        $teks = 'Kepala UPT';
                        if (str($namaSubOpd)->contains('biro')) {
                            $teks = 'Kepala Biro';
                        }
                    }

                    echo $teks;
                @endphp
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">{{ $namaKepala ?? '(Belum mengisi nama kepala perangkat daerah/upt/biro)' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">NIP: {{ $nip ?? 'Belum mengisi nip' }}</td>
        </tr>
    </tbody>
</table>
