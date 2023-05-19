<x-laporan :$jenisLaporan :$urusan :$subOpd :$opd :$namaPeriode>
    <tr style="text-align: center; vertical-align: center;">
        <td rowspan="4" style="{{ config('app.td_style') }}">Kode</td>
        <td rowspan="4" style="{{ config('app.td_style') }}">Nama Program/Kegiatan/Subkegiatan</td>
        <td rowspan="4" style="{{ config('app.td_style') }}">Jumlah Anggaran (Rp)</td>
        <td rowspan="4" style="{{ config('app.td_style') }}">Bobot (%)</td>
        <td colspan="9" style="{{ config('app.td_style') }}">Realisasi Pelaksanaan Anggaran</td>
        <td rowspan="4" style="{{ config('app.td_style') }}">Sisa Anggaran (Rp)</td>
    </tr>
    <tr>
        <td colspan="3" style="{{ config('app.td_style') }}">Bulan Lalu</td>
        <td colspan="3" style="{{ config('app.td_style') }}">Bulan Ini</td>
        <td colspan="3" style="{{ config('app.td_style') }}">s.d. Bulan Ini</td>
    </tr>
    <tr>
        <td colspan="2" style="{{ config('app.td_style') }}">Keuangan</td>
        <td rowspan="2" style="{{ config('app.td_style') }}">Fisik (%)</td>
        <td colspan="2" style="{{ config('app.td_style') }}">Keuangan</td>
        <td rowspan="2" style="{{ config('app.td_style') }}">Fisik (%)</td>
        <td colspan="2" style="{{ config('app.td_style') }}">Keuangan</td>
        <td rowspan="2" style="{{ config('app.td_style') }}">Fisik (%)</td>
    </tr>
    <tr>
        <td style="{{ config('app.td_style') }}">Rp.</td>
        <td style="{{ config('app.td_style') }}">%</td>
        <td style="{{ config('app.td_style') }}">Rp.</td>
        <td style="{{ config('app.td_style') }}">%</td>
        <td style="{{ config('app.td_style') }}">Rp.</td>
        <td style="{{ config('app.td_style') }}">%</td>
    </tr>
    <tr>
        <td style="{{ config('app.td_style') }}">1</td>
        <td style="{{ config('app.td_style') }}">2</td>
        <td style="{{ config('app.td_style') }}">3</td>
        <td style="{{ config('app.td_style') }}">4</td>
        <td style="{{ config('app.td_style') }}">5</td>
        <td style="{{ config('app.td_style') }}">6</td>
        <td style="{{ config('app.td_style') }}">7</td>
        <td style="{{ config('app.td_style') }}">8</td>
        <td style="{{ config('app.td_style') }}">9</td>
        <td style="{{ config('app.td_style') }}">10</td>
        <td style="{{ config('app.td_style') }}">11</td>
        <td style="{{ config('app.td_style') }}">12</td>
        <td style="{{ config('app.td_style') }}">13</td>
        <td style="{{ config('app.td_style') }}">14</td>
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
        // $i = 1;
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
                <td style="{{ config('app.td_style') }} text-align: left; font-weight: bold;">{{ $opd->kode_belanja_1 }}</td>
                <td style="font-weight: bold;">{{ $opd->nama_belanja_1 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryBelanja1->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja1 = $opd->nama_belanja_1;
                    $belanja2 = null;
                    $program = null;
                    $kegiatan = null;
                    $subKegiatan = null;
                    $belanja3 = null;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($belanja2 != $opd->nama_belanja_2)
            <tr>
                <td style="{{ config('app.td_style') }} text-align: left; font-weight: bold;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_belanja_2 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryBelanja2->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja2 = $opd->nama_belanja_2;
                    $program = null;
                    $kegiatan = null;
                    $subKegiatan = null;
                    $belanja3 = null;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($program != $opd->nama_program)
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_program }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $queryProgram->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiBulanLalu = $queryProgram->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryProgram->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryProgram->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryProgram->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $program = $opd->nama_program;
                    $kegiatan = null;
                    $subKegiatan = null;
                    $belanja3 = null;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($kegiatan != $opd->nama_kegiatan)
            <x-table.baris-kosong jumlah="14" />
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_kegiatan }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryKegiatan->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiBulanLalu = $queryKegiatan->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryKegiatan->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryKegiatan->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryKegiatan->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $kegiatan = $opd->nama_kegiatan;
                    $subKegiatan = null;
                    $belanja3 = null;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($subKegiatan != $opd->nama_sub_kegiatan)
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan . '.' . $opd->kode_sub_kegiatan }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_sub_kegiatan }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $querySubKegiatan->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiBulanLalu = $querySubKegiatan->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $querySubKegiatan->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $querySubKegiatan->sum('realisasi_sd_bulan_ini');
                    $anggaran = $querySubKegiatan->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $subKegiatan = $opd->nama_sub_kegiatan;
                    $belanja3 = null;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($belanja3 != $opd->nama_belanja_3)
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_belanja_3 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryBelanja3->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiBulanLalu = $queryBelanja3->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryBelanja3->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja3->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryBelanja3->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;

                    $pembagiFisik = $queryBelanja3->count();

                    $realisasiFisikBulanLalu = $queryBelanja3->sum('realisasi_fisik_bulan_lalu') / $pembagiFisik;
                    $realisasiFisikBulanIni = $queryBelanja3->sum('realisasi_fisik_bulan_ini') / $pembagiFisik;
                    $realisasiFisikSdBulanIni = $queryBelanja3->sum('realisasi_fisik_sd_bulan_ini') / $pembagiFisik;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanLalu }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $belanja3 = $opd->nama_belanja_3;
                    $belanja4 = null;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($belanja4 != $opd->nama_belanja_4)
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_belanja_4 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryBelanja4->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                @php
                    $realisasiBulanLalu = $queryBelanja4->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryBelanja4->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja4->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryBelanja4->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;

                    $pembagiFisik = $queryBelanja4->count();

                    $realisasiFisikBulanLalu = $queryBelanja4->sum('realisasi_fisik_bulan_lalu') / $pembagiFisik;
                    $realisasiFisikBulanIni = $queryBelanja4->sum('realisasi_fisik_bulan_ini') / $pembagiFisik;
                    $realisasiFisikSdBulanIni = $queryBelanja4->sum('realisasi_fisik_sd_bulan_ini') / $pembagiFisik;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanLalu }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $belanja4 = $opd->nama_belanja_4;
                    $belanja5 = null;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($belanja5 != $opd->nama_belanja_5)
            <tr>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_belanja_5 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $queryBelanja5->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>

                @php
                    $realisasiBulanLalu = $queryBelanja5->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryBelanja5->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja5->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryBelanja5->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;

                    $pembagiFisik = $queryBelanja5->count();

                    $realisasiFisikBulanLalu = $queryBelanja5->sum('realisasi_fisik_bulan_lalu') / $pembagiFisik;
                    $realisasiFisikBulanIni = $queryBelanja5->sum('realisasi_fisik_bulan_ini') / $pembagiFisik;
                    $realisasiFisikSdBulanIni = $queryBelanja5->sum('realisasi_fisik_sd_bulan_ini') / $pembagiFisik;
                @endphp
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanLalu }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $realisasiFisikSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }} font-weight: bold; text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $belanja5 = $opd->nama_belanja_5;
                    $belanja6 = null;
                @endphp
            </tr>
        @endif
        @if ($belanja6 != $opd->nama_belanja_6)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 . '.' . $opd->kode_belanja_6 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_belanja_6 }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $queryBelanja6->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiBulanLalu = $queryBelanja6->sum('realisasi_bulan_lalu');
                    $realisasiBulanIni = $queryBelanja6->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja6->sum('realisasi_sd_bulan_ini');
                    $anggaran = $queryBelanja6->sum('anggaran');
                    $sisaAnggaran = $anggaran - $realisasiSdBulanIni;

                    $realisasiFisikBulanLalu = $queryBelanja6->sum('realisasi_fisik_bulan_lalu');
                    $realisasiFisikBulanIni = $queryBelanja6->sum('realisasi_fisik_bulan_ini');                    $realisasiFisikSdBulanIni = $queryBelanja6->sum('realisasi_fisik_sd_bulan_ini');
                @endphp
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiBulanLalu }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanLalu / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiFisikBulanLalu }}</td>

                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiBulanIni }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiFisikBulanIni }}</td>

                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $anggaran == 0 ? 0 : $realisasiSdBulanIni / $anggaran }}</td>
                <td style="{{ config('app.td_style') }} text-align: right;">{{ $realisasiFisikSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }} text-align: right;">{{ $sisaAnggaran }}</td>
                @php
                    $belanja6 = $opd->nama_belanja_6;
                @endphp
            </tr>
        @endif
        {{-- @php
            $i++;
        @endphp --}}
    @endforeach

    <tr>
        <td colspan="2" style="{{ config('app.td_style') }} text-align: right; font-weight: bold;">Jumlah Belanja</td>
        <td style="{{ config('app.td_style') }} text-align: right;">{{ $opds->sum('anggaran') }}</td>
        <td style="{{ config('app.td_style') }}"></td>

        <td style="{{ config('app.td_style') }} text-align: right;">{{ $opds->sum('realisasi_bulan_lalu') }}</td>
        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>

        <td style="{{ config('app.td_style') }} text-align: right;">{{ $opds->sum('realisasi_bulan_ini') }}</td>
        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>

        <td style="{{ config('app.td_style') }} text-align: right;">{{ $opds->sum('realisasi_sd_bulan_ini') }}</td>
        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>
    </tr>

    <x-laporan.sum-kelompok-belanja :rows="$opds" />
</x-laporan>
