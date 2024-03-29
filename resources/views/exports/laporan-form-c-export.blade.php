<x-laporan :$jenisLaporan :$urusan :$subOpd :$opd :$namaPeriode lebar-margin-kiri="8">
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr style="text-align: center; vertical-align: center;">
        <td rowspan="3" style="border:1px solid black;padding:5px;">Kode</td>
        <td rowspan="3" style="border:1px solid black;padding:5px;">Nama Program/Kegiatan/Subkegiatan</td>
        <td rowspan="3" style="border:1px solid black;padding:5px;">Jumlah Anggaran (Rp)</td>
        <td colspan="3" style="border:1px solid black;padding:5px;">Penyerapan Anggaran</td>
        <td rowspan="3" style="border:1px solid black;padding:5px;">Sisa Anggaran (Rp)</td>
        <td rowspan="3" style="border:1px solid black;padding:5px;">Penanggungjawab Kegiatan</td>
    </tr>
    <tr>
        <td colspan="2" style="border:1px solid black;padding:5px;">Realisasi Keuangan</td>
        <td rowspan="2" style="border:1px solid black;padding:5px;">Fisik</td>
    </tr>
    <tr>
        <td style="border:1px solid black;padding:5px;">Rp.</td>
        <td style="border:1px solid black;padding:5px;">%</td>
    </tr>
    <tr>
        <td style="border:1px solid black;padding:5px;">1</td>
        <td style="border:1px solid black;padding:5px;">2</td>
        <td style="border:1px solid black;padding:5px;">3</td>
        <td style="border:1px solid black;padding:5px;">4</td>
        <td style="border:1px solid black;padding:5px;">5</td>
        <td style="border:1px solid black;padding:5px;">6</td>
        <td style="border:1px solid black;padding:5px;">7</td>
        <td style="border:1px solid black;padding:5px;">8</td>
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
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja1->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $belanja1 = $opd->nama_belanja_1;
                @endphp
            </tr>
        @endif
        @if ($belanja2 != $opd->nama_belanja_2)
            <tr>
                <td style="border:1px solid black;padding:5px; text-align: left;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_2 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja2->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $belanja2 = $opd->nama_belanja_2;
                @endphp
            </tr>
        @endif
        @if ($program != $opd->nama_program)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_program }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryProgram->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $program = $opd->nama_program;
                @endphp
            </tr>
        @endif
        @if ($kegiatan != $opd->nama_kegiatan)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_kegiatan }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryKegiatan->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $kegiatan = $opd->nama_kegiatan;
                @endphp
            </tr>
        @endif
        @if ($subKegiatan != $opd->nama_sub_kegiatan)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_urusan . '.' . $opd->kode_bidang_urusan . '.' . $opd->kode_program . '.' . $opd->kode_kegiatan . '.' . $opd->kode_sub_kegiatan }}</td>
                <td style="border:1px solid black;padding:5px;">Sub Kegiatan: {{ $opd->nama_sub_kegiatan }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $querySubKegiatan->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $subKegiatan = $opd->nama_sub_kegiatan;
                @endphp
            </tr>
        @endif
        @if ($belanja3 != $opd->nama_belanja_3)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_3 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja3->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $belanja3 = $opd->nama_belanja_3;
                @endphp
            </tr>
        @endif
        @if ($belanja4 != $opd->nama_belanja_4)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_4 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja4->sum('anggaran') }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $belanja4 = $opd->nama_belanja_4;
                @endphp
            </tr>
        @endif
        @if ($belanja5 != $opd->nama_belanja_5)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_5 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja5->sum('anggaran') }}</td>

                @php
                    $realisasiTriwulanIni = $queryBelanja5->sum('realisasi_bulan_ini');
                    $anggaranTriwulanIni = $queryBelanja5->sum('anggaran_bulan_ini');

                    $prosentaseTriwulanIni = $anggaranTriwulanIni == 0 ? 0 : $realisasiTriwulanIni / $anggaranTriwulanIni;
                    $sisaAnggaranTriwulanIni = $anggaranTriwulanIni - $realisasiTriwulanIni;
                @endphp
                <td style="border:1px solid black;padding:5px;">{{ $realisasiTriwulanIni }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $prosentaseTriwulanIni }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;">{{ $sisaAnggaranTriwulanIni }}</td>
                <td style="border:1px solid black;padding:5px;"></td>
                @php
                    $belanja5 = $opd->nama_belanja_5;
                @endphp
            </tr>
        @endif
        @if ($belanja6 != $opd->nama_belanja_6)
            <tr>
                <td style="border:1px solid black;padding:5px;">{{ $opd->kode_belanja_1 . $opd->kode_belanja_2 . '.' . $opd->kode_belanja_3 . '.' . $opd->kode_belanja_4 . '.' . $opd->kode_belanja_5 . '.' . $opd->kode_belanja_6 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $opd->nama_belanja_6 }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $queryBelanja6->sum('anggaran') }}</td>

                @php
                    $realisasiTriwulanIni = $queryBelanja6->sum('realisasi_bulan_ini');
                    $anggaranTriwulanIni = $queryBelanja6->sum('anggaran_bulan_ini');

                    $prosentaseTriwulanIni = $anggaranTriwulanIni == 0 ? 0 : $realisasiTriwulanIni / $anggaranTriwulanIni;
                    $sisaAnggaranTriwulanIni = $anggaranTriwulanIni - $realisasiTriwulanIni;
                @endphp
                <td style="border:1px solid black;padding:5px;">{{ $realisasiTriwulanIni }}</td>
                <td style="border:1px solid black;padding:5px;">{{ $prosentaseTriwulanIni }}</td>

                <td style="border:1px solid black;padding:5px;"></td>
                <td style="border:1px solid black;padding:5px;">{{ $sisaAnggaranTriwulanIni }}</td>
                <td style="border:1px solid black;padding:5px;"></td>
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
        <td colspan="2" style="border:1px solid black;padding:5px; text-align: right; font-weight: bold;">Jumlah Belanja</td>
        <td style="border:1px solid black;padding:5px;">{{ $opds->sum('anggaran') }}</td>
        <td style="border:1px solid black;padding:5px;">{{ $opds->sum('realisasi_bulan_ini') }}</td>
        <td style="border:1px solid black;padding:5px;"></td>
        <td style="border:1px solid black;padding:5px;"></td>
        <td style="border:1px solid black;padding:5px;">{{ $opds->sum('anggaran_bulan_ini') }}</td>
        <td style="border:1px solid black;padding:5px;"></td>
    </tr>

    <x-laporan.sum-kelompok-belanja :rows="$opds" />
</x-laporan>
