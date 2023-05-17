@props(['jenisLaporan', 'urusan', 'subOpd', 'opd', 'namaPeriode', 'namaKepala', 'nip'])

<table style="font-family: Arial, Helvetica, sans-serif;">
  <tbody>
      <tr>
          <td colspan="14" style="text-align: right;">FORM. {{ str($jenisLaporan)->title() }}</td>
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
          <td style="font-weight: bold;">: {{ $urusan->kode . '. ' .$urusan->nama }}</td>
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
          <td style="font-weight: bold;">
              {{ filled($subOpd) ? $opd->kode . '. ' . $opd->nama . ' - ' . $subOpd->nama : $opd->kode . '. ' . $opd->nama }}
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
          <td style="font-weight: bold;">: {{ $namaPeriode }}</td>
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
      {{ $slot }}

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
          <td colspan="4" style="text-align: center;">Mataram, {{ \App\Helpers\FormatHelper::tanggal(today()) }}</td>
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
          <td colspan="4" style="text-align: center;">
              @php
                  $teks = 'Kepala Perangkat Daerah';
                  if (filled($subOpd)) {
                      $teks = 'Kepala UPT';
                      if (str($subOpd->nama)->contains('biro')) {
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
          <td colspan="4"  style="text-align: center;">{{ $opd->nama_kepala ?? '(Belum mengisi nama kepala perangkat daerah/upt/biro)' }}</td>
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
          <td colspan="4" style="text-align: center;">NIP: {{ $opd->nip_kepala ?? 'Belum mengisi nip' }}</td>
      </tr>
  </tbody>
</table>
