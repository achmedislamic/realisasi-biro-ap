@props(['colspanRealisasi', 'periode', 'foreachCount', 'denganTarget' => true])
@php
    $colspan = $denganTarget ? 4 : 2;
@endphp
<x-table.thead>
    <tr>
        <x-table.th rowspan="3">
            {{ auth()->user()->isOpd()? 'Sub ': '' }}OPD
        </x-table.th>
        <x-table.th rowspan="3" class="text-right">
            Anggaran
        </x-table.th>
        <x-table.th colspan="{{ $colspanRealisasi }}" class="text-center">
            Realisasi
        </x-table.th>
    </tr>
    <tr>
        @if ($periode == 'bulan')
            <x-table.th colspan="{{ $colspan }}" class="text-center">Januari</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Februari</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Maret</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">April</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Mei</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Juni</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Juli</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Agustus</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">September</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Oktober</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">November</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Desember</x-table.th>
        @elseif($periode == 'triwulan')
            <x-table.th colspan="{{ $colspan }}" class="text-center">Triwulan 1</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Triwulan 2</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Triwulan 3</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Triwulan 4</x-table.th>
        @elseif($periode == 'semester')
            <x-table.th colspan="{{ $colspan }}" class="text-center">Semester 1</x-table.th>
            <x-table.th colspan="{{ $colspan }}" class="text-center">Semester 2</x-table.th>
        @elseif($periode == 'tahun')
            <x-table.th colspan="{{ $colspan }}" class="text-center">Tahunan</x-table.th>
        @endif

    </tr>
    <tr>
        @for ($i = 1; $i <= $foreachCount; $i++)
            @if ($denganTarget)
                <x-table.th class="text-center">Target</x-table.th>
            @endif
            <x-table.th class="text-center">Jumlah</x-table.th>
            @if ($denganTarget)
                <x-table.th class="text-center">Persentase</x-table.th>
            @endif
            <x-table.th class="text-center">Fisik</x-table.th>
        @endfor
    </tr>
</x-table.thead>
