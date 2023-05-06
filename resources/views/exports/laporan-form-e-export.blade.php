<table style="font-family: Arial, Helvetica, sans-serif;">
    <tbody>
        <tr>
            <td style="{{ config('app.td_style') }}" colspan="6">FORMAT RINCIAN MASALAH LAPORAN {{ $periodeTeks }}</td>
        </tr>

        <tr>
            <td style="{{ config('app.td_style') }}">No.</td>
            <td style="{{ config('app.td_style') }}">Kode</td>
            <td style="{{ config('app.td_style') }}">Program/Kegiatan</td>
            <td style="{{ config('app.td_style') }}">Kendala</td>
            <td style="{{ config('app.td_style') }}">Tindaklanjut yang perlu dilakukan</td>
            <td style="{{ config('app.td_style') }}">Pihak yang diharapkan dapat membantu penyelesaian masalah</td>
        </tr>

        <tr>
            <td style="{{ config('app.td_style') }}">1</td>
            <td style="{{ config('app.td_style') }}">2</td>
            <td style="{{ config('app.td_style') }}">3</td>
            <td style="{{ config('app.td_style') }}">4</td>
            <td style="{{ config('app.td_style') }}">5</td>
            <td style="{{ config('app.td_style') }}">6</td>
        </tr>

        @php
            $namaProgram = null;
            $namaKegiatan = null;
            $namaSubKegiatan = null;
        @endphp
        @foreach ($rincianMasalahs as $rincianMasalah)
            @if ($namaProgram != $rincianMasalah->nama_program)
                <tr>
                    <td style="{{ config('app.td_style') }}">{{ $loop->iteration }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->kode_urusan . '.' . $rincianMasalah->kode_bidang_urusan . '.' . $rincianMasalah->kode_program }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->nama_program }}</td>

                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}"></td>
                </tr>
                @php
                    $namaProgram = $rincianMasalah->nama_program;
                @endphp
            @endif

            @if ($namaKegiatan != $rincianMasalah->nama_kegiatan)
                <tr>
                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->kode_urusan . '.' . $rincianMasalah->kode_bidang_urusan . '.' . $rincianMasalah->kode_program . '.' . $rincianMasalah->kode_kegiatan }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->nama_kegiatan }}</td>

                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}"></td>
                </tr>
                @php
                    $namaKegiatan = $rincianMasalah->nama_kegiatan;
                @endphp
            @endif

            @if ($namaSubKegiatan != $rincianMasalah->nama_sub_kegiatan)
                <tr>
                    <td style="{{ config('app.td_style') }}"></td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->kode_urusan . '.' . $rincianMasalah->kode_bidang_urusan . '.' . $rincianMasalah->kode_program . '.' . $rincianMasalah->kode_kegiatan . '.' . $rincianMasalah->kode_sub_kegiatan }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->nama_sub_kegiatan }}</td>

                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->kendala }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->tindak_lanjut }}</td>
                    <td style="{{ config('app.td_style') }}">{{ $rincianMasalah->pihak }}</td>
                </tr>
                @php
                    $namaSubKegiatan = $rincianMasalah->nama_sub_kegiatan;
                @endphp
            @endif
        @endforeach

        <tr>
            <td colspan="6"></td>
        </tr>

        <tr>
            <td colspan="3"></td>
            <td colspan="3" style="text-align: center;">Mataram, {{ \App\Helpers\FormatHelper::tanggal(now()) }}</td>
        </tr>

        @if (filled($subOpd))
            <tr>
                <td colspan="3"></td>
                <td colspan="3" style="text-align: center;">
                    {{ $subOpd->is_biro ? 'Kepala Biro ' . $subOpd->nama : 'Kepala UPTD ' . $subOpd->nama }}
                </td>
            </tr>
        @endif

        <tr>
            <td colspan="3"></td>
            <td colspan="3" style="text-align: center;">
                {{ blank($subOpd) ? 'Kepala ' : '' }}{{ $opd->nama }}
            </td>
        </tr>

        <tr>
            <td colspan="6"></td>
        </tr>

        <tr>
            <td colspan="6"></td>
        </tr>

        <tr>
            <td colspan="6"></td>
        </tr>

        <tr>
            <td colspan="3"></td>
            <td colspan="3" style="text-align: center;">
                {{ filled($subOpd) ? $subOpd->nama_kepala : $opd->nama_kepala }}
            </td>
        </tr>

        <tr>
            <td colspan="3"></td>
            <td colspan="3" style="text-align: center;">
                NIP. {{ filled($subOpd) ? $subOpd->nip_kepala : $opd->nip_kepala }}
            </td>
        </tr>
    </tbody>
</table>
