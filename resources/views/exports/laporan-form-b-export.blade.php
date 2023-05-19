<x-laporan :$jenisLaporan :$urusan :$subOpd :$opd :$namaPeriode>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr style="text-align: center; vertical-align: center;">
        <td rowspan="3" style="{{ config('app.td_style') }}">Kode</td>
        <td rowspan="3" style="{{ config('app.td_style') }}">Nama Program/Kegiatan/Subkegiatan</td>
        <td rowspan="3" style="{{ config('app.td_style') }}">Jumlah Anggaran (Rp)</td>
        <td rowspan="3" style="{{ config('app.td_style') }}">Bobot (%)</td>
        <td colspan="8" style="{{ config('app.td_style') }}">Penyerapan Anggaran</td>
        <td colspan="2" style="{{ config('app.td_style') }}">Indikator Keluaran</td>
        <td rowspan="3" style="{{ config('app.td_style') }}">Sisa Anggaran (Rp)</td>
    </tr>
    <tr>
        <td colspan="2" style="{{ config('app.td_style') }}">Triwulan Lalu</td>
        <td colspan="2" style="{{ config('app.td_style') }}">Triwulan Ini</td>
        <td colspan="2" style="{{ config('app.td_style') }}">s.d. Bulan Ini</td>
        <td colspan="2" style="{{ config('app.td_style') }}">Prosentasi s.d. Triwulan Ini</td>
        <td rowspan="2" style="{{ config('app.td_style') }}">Narasi</td>
        <td rowspan="2" style="{{ config('app.td_style') }}">Satuan</td>
    </tr>
    <tr>
        <td style="{{ config('app.td_style') }}">Renc.</td>
        <td style="{{ config('app.td_style') }}">Real</td>
        <td style="{{ config('app.td_style') }}">Renc.</td>
        <td style="{{ config('app.td_style') }}">Real</td>
        <td style="{{ config('app.td_style') }}">Renc.</td>
        <td style="{{ config('app.td_style') }}">Real</td>
        <td style="{{ config('app.td_style') }}">Keu. (%)</td>
        <td style="{{ config('app.td_style') }}">Fisik. (%)</td>
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
        <td style="{{ config('app.td_style') }}">15</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja1 = $opd->nama_belanja_1;
                @endphp
            </tr>
        @endif
        @if ($belanja2 != $opd->nama_belanja_2)
            <tr>
                <td style="{{ config('app.td_style') }} text-align: left; font-weight: bold;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 }}</td>
                <td style="{{ config('app.td_style') }} font-weight: bold;">{{ $opd->nama_belanja_2 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryBelanja2->sum('anggaran') }}</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja2 = $opd->nama_belanja_2;
                @endphp
            </tr>
        @endif
        @if ($program != $opd->nama_program)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_program }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryProgram->sum('anggaran') }}</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $program = $opd->nama_program;
                @endphp
            </tr>
        @endif
        @if ($kegiatan != $opd->nama_kegiatan)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_kegiatan }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryKegiatan->sum('anggaran') }}</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $kegiatan = $opd->nama_kegiatan;
                @endphp
            </tr>
        @endif
        @if ($subKegiatan != $opd->nama_sub_kegiatan)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan . '.' . $opd->kode_sub_kegiatan }}</td>
                <td style="{{ config('app.td_style') }}">Sub Kegiatan: {{ $opd->nama_sub_kegiatan }}</td>
                <td style="{{ config('app.td_style') }}">{{ $querySubKegiatan->sum('anggaran') }}</td>
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

                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $subKegiatan = $opd->nama_sub_kegiatan;
                @endphp
            </tr>
        @endif
        @if ($belanja3 != $opd->nama_belanja_3)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_belanja_3 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryBelanja3->sum('anggaran') }}</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja3 = $opd->nama_belanja_3;
                @endphp
            </tr>
        @endif
        @if ($belanja4 != $opd->nama_belanja_4)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_belanja_4 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryBelanja4->sum('anggaran') }}</td>
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
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja4 = $opd->nama_belanja_4;
                @endphp
            </tr>
        @endif
        @if ($belanja5 != $opd->nama_belanja_5)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_belanja_5 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryBelanja5->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiTriwulanLalu = $queryBelanja5->sum('realisasi_bulan_lalu');
                    $realisasiTriwulanIni = $queryBelanja5->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja5->sum('realisasi_sd_bulan_ini');

                    $anggaranTriwulanLalu = $queryBelanja5->sum('anggaran_bulan_lalu');
                    $anggaranTriwulanIni = $queryBelanja5->sum('anggaran_bulan_ini');
                    $anggaranSdBulanIni = $queryBelanja5->sum('anggaran_sd_bulan_ini');

                    $prosentaseSdTriwulanIni = $anggaranSdBulanIni == 0 ? 0 : $realisasiSdBulanIni / $anggaranSdBulanIni;
                @endphp
                <td style="{{ config('app.td_style') }}">{{ $anggaranTriwulanLalu }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiTriwulanLalu }}</td>
                <td style="{{ config('app.td_style') }}">{{ $anggaranTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $anggaranSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }}">{{ $prosentaseSdTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja5 = $opd->nama_belanja_5;
                @endphp
            </tr>
        @endif
        @if ($belanja6 != $opd->nama_belanja_6)
            <tr>
                <td style="{{ config('app.td_style') }}">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 . '.' . $opd->kode_belanja_6 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $opd->nama_belanja_6 }}</td>
                <td style="{{ config('app.td_style') }}">{{ $queryBelanja6->sum('anggaran') }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $realisasiTriwulanLalu = $queryBelanja6->sum('realisasi_bulan_lalu');
                    $realisasiTriwulanIni = $queryBelanja6->sum('realisasi_bulan_ini');
                    $realisasiSdBulanIni = $queryBelanja6->sum('realisasi_sd_bulan_ini');

                    $anggaranTriwulanLalu = $queryBelanja6->sum('anggaran_bulan_lalu');
                    $anggaranTriwulanIni = $queryBelanja6->sum('anggaran_bulan_ini');
                    $anggaranSdBulanIni = $queryBelanja6->sum('anggaran_sd_bulan_ini');

                    $prosentaseSdTriwulanIni = $anggaranSdBulanIni == 0 ? 0 : $realisasiSdBulanIni / $anggaranSdBulanIni;
                @endphp
                <td style="{{ config('app.td_style') }}">{{ $anggaranTriwulanLalu }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiTriwulanLalu }}</td>
                <td style="{{ config('app.td_style') }}">{{ $anggaranTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $anggaranSdBulanIni }}</td>
                <td style="{{ config('app.td_style') }}">{{ $realisasiSdBulanIni }}</td>

                <td style="{{ config('app.td_style') }}">{{ $prosentaseSdTriwulanIni }}</td>
                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>

                <td style="{{ config('app.td_style') }}"></td>
                <td style="{{ config('app.td_style') }}"></td>
                @php
                    $belanja6 = $opd->nama_belanja_6;
                @endphp
            </tr>
        @endif
        @php
            $i++;
        @endphp
    @endforeach

    <tr>
        <td colspan="2" style="{{ config('app.td_style') }} text-align: right; font-weight: bold;">Jumlah Belanja</td>
        <td style="{{ config('app.td_style') }}">{{ $opds->sum('anggaran') }}</td>
        <td style="{{ config('app.td_style') }}"></td>

        <td style="{{ config('app.td_style') }}">{{ $opds->sum('anggaran_bulan_lalu') }}</td>
        <td style="{{ config('app.td_style') }}">{{ $opds->sum('realisasi_bulan_lalu') }}</td>
        <td style="{{ config('app.td_style') }}">{{ $opds->sum('anggaran_bulan_ini') }}</td>
        <td style="{{ config('app.td_style') }}">{{ $opds->sum('realisasi_bulan_ini') }}</td>

        <td style="{{ config('app.td_style') }}">{{ $opds->sum('anggaran_sd_bulan_ini') }}</td>
        <td style="{{ config('app.td_style') }}">{{ $opds->sum('realisasi_sd_bulan_ini') }}</td>
        <td style="{{ config('app.td_style') }}"></td>

        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>
        <td style="{{ config('app.td_style') }}"></td>
    </tr>

    <x-laporan.sum-kelompok-belanja :rows="$opds" />
</x-laporan>
