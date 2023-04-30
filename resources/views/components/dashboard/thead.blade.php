@props(['colspanRealisasi', 'periode', 'foreachCount'])
<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
  <tr>
      <th rowspan="3" scope="col" class="px-6 py-3">
          {{ auth()->user()->isOpd()? 'Sub ': '' }}OPD
      </th>
      <th rowspan="3" scope="col" class="px-6 py-3 text-right">
          Anggaran
      </th>
      <th {{ $colspanRealisasi }} scope="col" class="px-6 py-3 text-center">
          Realisasi
      </th>
      <th scope="col" class="px-6 py-3 text-right">
          Persentase
      </th>
  </tr>
  <tr>
      @if ($periode == 'bulan')
          <th colspan="3" class="text-center">Januari</th>
          <th colspan="3" class="text-center">Februari</th>
          <th colspan="3" class="text-center">Maret</th>
          <th colspan="3" class="text-center">April</th>
          <th colspan="3" class="text-center">Mei</th>
          <th colspan="3" class="text-center">Juni</th>
          <th colspan="3" class="text-center">Juli</th>
          <th colspan="3" class="text-center">Agustus</th>
          <th colspan="3" class="text-center">September</th>
          <th colspan="3" class="text-center">Oktober</th>
          <th colspan="3" class="text-center">November</th>
          <th colspan="3" class="text-center">Desember</th>
      @elseif($periode == 'triwulan')
          <th colspan="3" class="text-center">Triwulan 1</th>
          <th colspan="3" class="text-center">Triwulan 2</th>
          <th colspan="3" class="text-center">Triwulan 3</th>
          <th colspan="3" class="text-center">Triwulan 4</th>
      @elseif($periode == 'semester')
          <th colspan="3" class="text-center">Semester 1</th>
          <th colspan="3" class="text-center">Semester 2</th>
      @elseif($periode == 'tahun')
          <th colspan="3" class="text-center">Tahunan</th>
      @endif

  </tr>
  <tr>
      @for ($i = 1; $i <= $foreachCount; $i++)
          <th class="text-center">Target</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Persentase</th>
      @endfor
  </tr>
</thead>
