@props(['opds', 'targetOpds', 'periode', 'foreachCount'])
@php
    $totalAnggaran = 0;
    $totalTarget = [];
    $totalRealisasi = [];
    $totalRealisasiFisik = [];
@endphp
@foreach ($opds as $opd)
    <x-table.tr>
        <th scope="row" class="py-3 px-3 border border-slate-400 whitespace-nowrap {{ isset($opd->is_biro) && $opd->is_biro == 0 ? 'hover:underline hover:text-blue-500 hover:cursor-pointer' : '' }}">
            <div class="flex flex-row justify-between ">
                <p {!! isset($opd->is_biro) && $opd->is_biro == 0 ? "wire:click=\"\$emit('opdDashboardClicked', {$opd->id}, '{$periode}')\"" : '' !!}>{{ $opd->nama_pd }}</p>
                @can('is-admin')
                    @if (isset($opd->is_biro))
                        <div>
                            <x-button xs target="_blank" href="{!! route('realisasi', ['opdPilihan' => $opd->is_biro == 1 ? $opd->opd_id : $opd->id, 'subOpdPilihan' => $opd->is_biro == 1 ? $opd->id : '']) !!}" primary label="Detail" />
                        </div>
                    @endif
                @endcan
            </div>

        </th>
        <x-table.td class="text-right">
            {{ \App\Helpers\FormatHelper::angka($opd->anggaran) }}
        </x-table.td>
        @php
            $jumlahRealisasi = [];
            $jumlahRealisasiFisik = [];
            $jumlahTarget = [];
        @endphp
        @for ($i = 1; $i <= $foreachCount; $i++)
            @php
                $target = $targetOpds
                    ->when(isset($opd->is_biro) && $opd->is_biro == 0, fn($query) => $query->where('targetable_type', 'opd'))
                    ->when(isset($opd->is_biro) && $opd->is_biro == 1, fn($query) => $query->where('targetable_type', 'sub_opd'))
                    ->where('targetable_id', $opd->id)
                    ->when($periode == 'bulan', fn($query) => $query->where('bulan', $i))
                    ->when($periode == 'triwulan', function ($query) use ($i) {
                        if ($i == 1) {
                            return $query->whereIn('bulan', [1, 2, 3]);
                        }

                        if ($i == 2) {
                            return $query->whereIn('bulan', [4, 5, 6]);
                        }

                        if ($i == 3) {
                            return $query->whereIn('bulan', [7, 8, 9]);
                        }

                        if ($i == 4) {
                            return $query->whereIn('bulan', [10, 11, 12]);
                        }
                    })
                    ->when($periode == 'semester', function ($query) use ($i) {
                        if ($i == 1) {
                            return $query->whereIn('bulan', [1, 2, 3, 4, 5, 6]);
                        }

                        if ($i == 2) {
                            return $query->whereIn('bulan', [7, 8, 9, 10, 11, 12]);
                        }
                    });

                if ($periode == 'bulan') {
                    $target = $target->first()->jumlah ?? 0;
                } else {
                    $target = $target->sum('jumlah') ?? 0;
                }
                $realisasi = match ($periode) {
                    'bulan' => $opd->{'realisasi_' . $i} ?? 0,
                    'triwulan' => $opd->{'realisasi_triwulan_' . $i} ?? 0,
                    'semester' => $opd->{'realisasi_semester_' . $i} ?? 0,
                    'tahun' => $opd->realisasi ?? 0,
                };

                $realisasiFisik = match ($periode) {
                    'bulan' => $opd->{'realisasi_fisik_' . $i} ?? 0,
                    'triwulan' => $opd->{'realisasi_triwulan_fisik_' . $i} ?? 0,
                    'semester' => $opd->{'realisasi_semester_fisik_' . $i} ?? 0,
                    'tahun' => $opd->realisasi_fisik ?? 0,
                };
                $persentase = $target == 0 ? 0 : $realisasi / $target;
            @endphp
            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($target) }}
            </x-table.td>

            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($realisasi) }}
            </x-table.td>

            <x-table.td @class([
                'text-right',
                'bg-yellow-500' => $persentase >= 41 && $persentase <= 70,
                'bg-green-500' => $persentase >= 71,
                'bg-red-500 text-white' => $persentase <= 40,
            ])>
                {{ \App\Helpers\FormatHelper::angka($persentase) }}
            </x-table.td>

            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($realisasiFisik) }}
            </x-table.td>
            @php
                array_push($jumlahTarget, $target); //per periode
                array_push($jumlahRealisasi, $realisasi);
                array_push($jumlahRealisasiFisik, $realisasiFisik);
            @endphp
        @endfor
    </x-table.tr>

    @php
        $totalAnggaran = $totalAnggaran + $opd->anggaran;

        $totalTarget = array_map(fn() => array_sum(func_get_args()), $totalTarget, $jumlahTarget);
        $totalRealisasi = array_map(fn() => array_sum(func_get_args()), $totalRealisasi, $jumlahRealisasi);
        $totalRealisasiFisik = array_map(fn() => array_sum(func_get_args()), $totalRealisasiFisik, $jumlahRealisasiFisik);
    @endphp
@endforeach
<tr>
    <x-table.td class="text-right font-bold">
        Total
    </x-table.td>
    <x-table.td class="text-right font-bold">
        {{ \App\Helpers\FormatHelper::angka($totalAnggaran) }}
    </x-table.td>
    @for ($j = 0; $j < $foreachCount; $j++)
        <x-table.td class="text-right font-bold">
            {{ \App\Helpers\FormatHelper::angka($totalTarget[$j]) }}
        </x-table.td>
        <x-table.td class="text-right font-bold">
            {{ \App\Helpers\FormatHelper::angka($totalRealisasi[$j]) }}
        </x-table.td>
        <x-table.td class="text-right font-bold">

        </x-table.td>
        <x-table.td class="text-right font-bold">
            {{ \App\Helpers\FormatHelper::angka($totalRealisasiFisik[$j]) }}
        </x-table.td>
    @endfor
</tr>
