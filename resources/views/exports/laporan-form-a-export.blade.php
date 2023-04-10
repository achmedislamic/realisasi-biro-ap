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
      $program = null;
      $kegiatan = null;
      $subKegiatan = null;
      $i = 1;
    @endphp
    @foreach ($rows as $row)

    <tr>
      <td>{{ $i++ }}</td>
	  @if ($program != $row->nama_program)
		  <td>{{ $row->nama_program }}</td>
		  <td>{{ $rows->where('tahapan_apbd_id', cache('tahapanApbd')->id)->where('sub_opd_id') }}</td>
		  @php
			  $program = $row->nama_program;
		  @endphp
	  @endif
    </tr>
    @endforeach
  </tbody>
  </table>
