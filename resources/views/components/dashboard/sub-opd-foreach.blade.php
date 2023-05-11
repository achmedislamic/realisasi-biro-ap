@props(['subOpds', 'periode', 'targetSubOpds', 'foreachCount'])

@foreach ($subOpds as $subOpd)
    <x-table.tr>
        <x-table.th>
            {{ $subOpd->nama_sub_opd }}
        </x-table.th>
        <x-table.td class="text-right">
            {{ \App\Helpers\FormatHelper::angka($subOpd->anggaran) }}
        </x-table.td>

        {{-- dapatkan target, jumlah realisasi, persentase --}}
        @for ($i = 1; $i <= $foreachCount; $i++)
            @php
                $target = $targetSubOpds
                    ->where('targetable_id', $subOpd->id)
                    ->when($periode == 'bulan', function ($query) use ($i) {
                        return $query->where('bulan', $i);
                    })
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
                    'bulan' => $subOpd->{'realisasi_' . $i} ?? 0,
                    'triwulan' => $subOpd->{'realisasi_triwulan_' . $i} ?? 0,
                    'semester' => $subOpd->{'realisasi_semester' . $i} ?? 0,
                    'tahun' => $subOpd->realisasi ?? 0,
                };
                $persentase = $target == 0 ? 0 : $realisasi / $target;

            @endphp
            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($target) }}
            </x-table.td>

            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($realisasi) }}
            </x-table.td>

            <x-table.td class="text-right">
                {{ \App\Helpers\FormatHelper::angka($persentase) }}
            </x-table.td>
        @endfor

    </x-table.tr>
@endforeach
