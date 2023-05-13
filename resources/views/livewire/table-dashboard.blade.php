<div wire:poll.10000ms class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-3">
    Waktu saat ini: {{ \App\Helpers\FormatHelper::tanggal(now(), true) }}
    <div class="flex flex-row space-x-3">
        <div class="w-full flex flex-col align-center">
            <div class="flex flex-row space-x-2">
                <div class="w-16 h-8 bg-red-500"></div>
                <p>Realisasi < 40%</p>
            </div>

            <div class="flex flex-row space-x-2">
                <div class="w-16 h-8 bg-yellow-500"></div>
                <p>Realisasi 41% - 70%</p>
            </div>

            <div class="flex flex-row space-x-2">
                <div class="w-16 h-8 bg-green-500"></div>
                <p>Realisasi 71% - 100%</p>
            </div>
        </div>
        <div class="w-full">
            <div class="flex flex-row space-x-3">
                <div class="w-full">
                    <x-native-select label="Periode" wire:model="periode">
                        <option value="bulan">Bulanan</option>
                        <option value="triwulan">Triwulan</option>
                        <option value="semester">Semester</option>
                        <option value="tahun">Tahunan</option>
                    </x-native-select>
                </div>
                @if ($periode == 'tahun')
                <x-native-select label="Periode" wire:model="urutan">
                    <option value="asc">Realisasi terendah ke tinggi</option>
                    <option value="desc">Realisasi tertinggi ke rendah</option>
                </x-native-select>
                @endif
            </div>
        </div>
    </div>
    <table class="border-collapse border border-slate-400 w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <x-dashboard.thead :$colspanRealisasi :$periode :$foreachCount />
        <tbody>
            @foreach ($opds as $opd)
                <x-table.tr>
                    <th {!! $opd->is_biro == 0 ? "wire:click=\"\$emit('opdDashboardClicked', {$opd->id}, '{$periode}')\"" : "" !!} scope="row" class="py-3 px-3 border border-slate-400 whitespace-nowrap {{ $opd->is_biro == 0 ? 'hover:underline hover:text-blue-500 hover:cursor-pointer' : '' }}">
                        {{ $opd->nama_pd }}
                    </th>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($opd->anggaran) }}
                    </x-table.td>
                    @for ($i = 1; $i <= $foreachCount; $i++)
                        @php
                            $target = $targetOpds
                                ->when($opd->is_biro == 0, fn ($query) => $query->where('targetable_type', 'opd'))
                                ->when($opd->is_biro == 1, fn ($query) => $query->where('targetable_type', 'sub_opd'))
                                ->where('targetable_id', $opd->id)
                                ->when($periode == 'bulan', fn ($query) => $query->where('bulan', $i))
                                ->when($periode == 'triwulan', function ($query) use ($i) {
                                    if($i == 1){
                                        return $query->whereIn('bulan', [1,2,3]);
                                    }

                                    if($i == 2){
                                        return $query->whereIn('bulan', [4,5,6]);
                                    }

                                    if($i == 3){
                                        return $query->whereIn('bulan', [7,8,9]);
                                    }

                                    if($i == 4){
                                        return $query->whereIn('bulan', [10,11,12]);
                                    }
                                })
                                ->when($periode == 'semester', function ($query) use ($i) {
                                    if($i == 1){
                                        return $query->whereIn('bulan', [1,2,3,4,5,6]);
                                    }

                                    if($i == 2){
                                        return $query->whereIn('bulan', [7,8,9,10,11,12]);
                                    }
                                });

                            if($periode == 'bulan'){
                                $target = $target->first()->jumlah ?? 0;
                            } else {
                                $target = $target->sum('jumlah') ?? 0;
                            }
                            $realisasi = match($periode) {
                                'bulan' => $opd->{'realisasi_' . $i} ?? 0,
                                'triwulan' => $opd->{'realisasi_triwulan_' . $i} ?? 0,
                                'semester' => $opd->{'realisasi_semester' . $i} ?? 0,
                                'tahun' => $opd->realisasi ?? 0,
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
        </tbody>
    </table>
</div>
