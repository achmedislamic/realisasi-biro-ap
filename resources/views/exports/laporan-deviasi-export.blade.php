<table style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black; border-collapse: collapse;">
	<tr>
		<td colspan="9" style="text-align: center; font-weight: 500">SERAPAN KEUANGAN PER OPD SAMPAI DENGAN {{ $periode }}</td>
	</tr>
	<tr>
		<td colspan="9" style="text-align: center; font-weight: 500">PEMERINTAH PROVINSI NUSA TENGGARA BARAT</td>
	</tr>
</table>
<table style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black; border-collapse: collapse;">
	<tr style="border: 1px solid black; border-collapse: collapse;">
		<td rowspan="2">No.</td>
		<td rowspan="2">Nama</td>
		<td rowspan="2">Pagu(Rp)</td>
		<td rowspan="2">Realisasi(Rp)</td>
		<td rowspan="2">Deviasi Serapan(Rp)</td>
		<td colspan="2">Realisasi</td>
		<td colspan="2">Deviasi</td>
	</tr>
	<tr>
		<td>Keu (%)</td>
		<td>Fisik (%)</td>
		<td>Keu (%)</td>
		<td>Fisik (%)</td>
	</tr>

	@php
		$jumlahPagu = 0;
		$jumlahRealisasi = 0;
		$jumlahDeviasi = 0;
		$jumlahRealisasiKeuangan = 0;
		$jumlahDeviasiKeuangan = 0
	@endphp
	@foreach ($rows as $row)
	@php
		$warnaPersenDeviasiKeuangan = 'green';
		if($row->persen_deviasi_keuangan >= 10 && $row->persen_deviasi_keuangan <= 25){
			$warnaPersenDeviasiKeuangan = 'yellow';
		} else {
			$warnaPersenDeviasiKeuangan = 'red';
		}

		$jumlahPagu = $jumlahPagu + $row->pagu;
		$jumlahRealisasi = $jumlahRealisasi + $row->realisasi;
		$jumlahDeviasi = $jumlahDeviasi + $row->deviasi;
	@endphp
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td style="white-space: no-wrap;">{{ $row->nama_opd }}</td>
		<td>{{ $row->pagu }}</td>
		<td>{{ $row->realisasi }}</td>
		<td>{{ $row->deviasi }}</td>
		<td>{{ $row->persen_realisasi_keuangan }}</td>
		<td></td>
		<td style="background-color: {{ $warnaPersenDeviasiKeuangan }};">{{ $row->persen_deviasi_keuangan }}</td>
		<td></td>
	</tr>
	@endforeach
	<tr style="font-weight: 500;">
		<td colspan="2" style="text-align: right;">Jumlah Belanja</td>
		<td>{{ $jumlahPagu }}</td>
		<td>{{ $jumlahRealisasi }}</td>
		<td>{{ $jumlahDeviasi }}</td>
		<td>{{ $jumlahRealisasiKeuangan }}</td>
		<td></td>
		<td>{{ $jumlahDeviasiKeuangan }}</td>
		<td></td>
	</tr>
</table>

<table style="font-family: Arial, Helvetica, sans-serif; border: 1px solid black; border-collapse: collapse;">
	<tr>
		<td colspan="5" style="text-align: center; border: 1px solid black; border-collapse: collapse;">Deviasi Keu. dan Fisik</td>
	</tr>
	<tr>
		<td>KINERJA</td>
		<td colspan="2">KEUANGAN</td>
		<td colspan="2">FISIK</td>
	</tr>
	<tr>
		<td>OPD</td>
		<td>%</td>
		<td>OPD</td>
		<td>%</td>
	</tr>
	<tr>
		<td style="background-color: green;">Hijau</td>
		<td>42</td>
		<td>85.71</td>
		<td>42</td>
		<td>85.71</td>
	</tr>
</table>
