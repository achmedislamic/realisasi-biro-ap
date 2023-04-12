<table>
    <tbody>
        <tr>
            <td colspan="14">FORM. A</td>
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
            <td colspan="14">LAPORAN BULANAN PELAKSANAAN PROGRAM/KEGIATAN/SUBKEGIATAN</td>
        </tr>
        <tr>
            <td colspan="14">DOKUMEN PELAKSANAAN ANGGARAN APBD PROVINSI NTB</td>
        </tr>
        <tr>
            <td colspan="14">TAHUN ANGGARAN...</td>
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
            <td>:</td>
            <td>...............</td>
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
            <td>:</td>
            <td>...............</td>
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
            <td>:</td>
            <td>Bulan ...</td>
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
            <td rowspan="4">No</td>
            <td rowspan="4">Nama Program/Kegiatan/Subkegiatan</td>
            <td rowspan="4">Jumlah Anggaran (Rp)</td>
            <td rowspan="4">Bobot (%)</td>
            <td colspan="9">Realisasi Pelaksanaan Anggaran</td>
            <td rowspan="4">Sisa Anggaran (Rp)</td>
        </tr>
        <tr>
            <td colspan="3">Bulan Lalu</td>
            <td colspan="3">Bulan Ini</td>
            <td colspan="3">s.d. Bulan Ini</td>
        </tr>
        <tr>
            <td colspan="2">Keuangan</td>
            <td rowspan="2">Fisik (%)</td>
            <td colspan="2">Keuangan</td>
            <td rowspan="2">Fisik (%)</td>
            <td colspan="2">Keuangan</td>
            <td rowspan="2">Fisik (%)</td>
        </tr>
        <tr>
            <td>Rp.</td>
            <td>%</td>
            <td>Rp.</td>
            <td>%</td>
            <td>Rp.</td>
            <td>%</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
        </tr>
        @php
            $urusan = null;
            $bidangUrusan = null;
            $program = null;
            $kegiatan = null;
            $subKegiatan = null;
            $i = 1;
        @endphp
        @foreach ($opds as $opd)
            @php
                $queryProgram = $opds
                    ->where('nama_urusan', $opd->nama_urusan)
                    ->where('nama_bidang_urusan', $opd->nama_bidang_urusan)
                    ->where('nama_opd', $opd->nama_opd)
                    ->where('nama_sub_opd', $opd->nama_sub_opd)
                    ->where('nama_program', $opd->nama_program);

                $queryKegiatan = $queryProgram->where('nama_kegiatan', $opd->nama_kegiatan);
                $querySubKegiatan = $queryKegiatan->where('nama_sub_kegiatan', $opd->nama_sub_kegiatan);
            @endphp
            @if ($urusan != $opd->nama_urusan && $bidangUrusan != $opd->nama_bidang_urusan && $program != $opd->nama_program)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $opd->nama_program }}</td>
                    <td>{{ $queryProgram->sum('anggaran') }}</td>
                    <td>Bobot Program</td>
                    @php
                        $realisasiBulanLalu = $queryProgram->sum('realisasi_bulan_lalu');
                        $realisasiBulanIni = $queryProgram->sum('realisasi_bulan_ini');
                        $realisasiSdBulanIni = $queryProgram->sum('realisasi_sd_bulan_ini');
                        $anggaran = $queryProgram->sum('anggaran');
                        $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                    @endphp
                    <td>{{ $realisasiBulanLalu }}</td>
                    <td>{{ ($realisasiBulanLalu / $anggaran) * 100 }}</td>
                    <td>FISIK</td>

                    <td>{{ $realisasiBulanIni }}</td>
                    <td>{{ ($realisasiBulanIni / $anggaran) * 100 }}</td>
                    <td>FISIK</td>

                    <td>{{ $realisasiSdBulanIni }}</td>
                    <td>{{ ($realisasiSdBulanIni / $anggaran) * 100 }}</td>
                    <td>FISIK</td>

                    <td>{{ $sisaAnggaran }}</td>
                    @php
                        $urusan = $opd->nama_urusan;
                        $bidangUrusan = $opd->nama_bidang_urusan;
                        $program = $opd->nama_program;
                    @endphp
                </tr>

                @if ($kegiatan != $opd->nama_kegiatan)
                    <tr>
                        <td></td>
                        <td style="padding-left: 1.25rem;">&nbsp;{{ $opd->nama_kegiatan }}</td>
                        <td>{{ $queryKegiatan->sum('anggaran') }}</td>
                        <td>Bobot Program</td>
                        @php
                            $realisasiBulanLalu = $queryKegiatan->sum('realisasi_bulan_lalu');
                            $realisasiBulanIni = $queryKegiatan->sum('realisasi_bulan_ini');
                            $realisasiSdBulanIni = $queryKegiatan->sum('realisasi_sd_bulan_ini');
                            $anggaran = $queryKegiatan->sum('anggaran');
                            $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                        @endphp
                        <td>{{ $realisasiBulanLalu }}</td>
                        <td>{{ ($realisasiBulanLalu / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $realisasiBulanIni }}</td>
                        <td>{{ ($realisasiBulanIni / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $realisasiSdBulanIni }}</td>
                        <td>{{ ($realisasiSdBulanIni / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $sisaAnggaran }}</td>
                        @php
                            $kegiatan = $opd->nama_kegiatan;
                        @endphp
                    </tr>

                    @if ($subKegiatan != $opd->nama_sub_kegiatan)
                    <tr>
                        <td></td>
                        <td style="padding-left: 1.25rem;">&nbsp;&nbsp;{{ $opd->nama_sub_kegiatan }}</td>
                        <td>{{ $querySubKegiatan->sum('anggaran') }}</td>
                        <td>Bobot Program</td>
                        @php
                            $realisasiBulanLalu = $querySubKegiatan->sum('realisasi_bulan_lalu');
                            $realisasiBulanIni = $querySubKegiatan->sum('realisasi_bulan_ini');
                            $realisasiSdBulanIni = $querySubKegiatan->sum('realisasi_sd_bulan_ini');
                            $anggaran = $querySubKegiatan->sum('anggaran');
                            $sisaAnggaran = $anggaran - $realisasiSdBulanIni;
                        @endphp
                        <td>{{ $realisasiBulanLalu }}</td>
                        <td>{{ ($realisasiBulanLalu / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $realisasiBulanIni }}</td>
                        <td>{{ ($realisasiBulanIni / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $realisasiSdBulanIni }}</td>
                        <td>{{ ($realisasiSdBulanIni / $anggaran) * 100 }}</td>
                        <td>FISIK</td>

                        <td>{{ $sisaAnggaran }}</td>
                        @php
                            $subKegiatan = $opd->nama_sub_kegiatan;
                        @endphp
                    </tr>
                @endif
                @endif
            @endif
            @php
                $i++;
            @endphp
        @endforeach
    </tbody>
</table>
