<div wire:poll.10000ms class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-3">
    Waktu saat ini: {{ now() }}
    <div class="flex flex-row space-x-3">
        <div class="ml-auto w-1/2 mb-3">
            <x-native-select label="Periode" wire:model="periode">
                <option value="bulan">Bulanan</option>
                <option value="triwulan">Triwulan</option>
                <option value="semester">Semester</option>
                <option value="tahun">Tahunan</option>
            </x-native-select>
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <x-dashboard.thead :$colspanRealisasi :$periode :$foreachCount />
        <tbody>
            <x-dashboard.sub-opd-foreach :subOpds="$biros" :$periode :targetSubOpds="$targetBiros" :$foreachCount />

            @foreach ($opds as $opd)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th {{ isset($opd->nama_opd) ? 'wire:click="$emit(\'opdDashboardClicked\', {$opd->id}, \'{$periode}\')"' : "" }} scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white {{ isset($opd->nama_opd) ? 'hover:underline hover:text-blue-500 hover:cursor-pointer' : '' }}">
                        {{ $opd->nama_opd ?? $opd->nama_sub_opd }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($opd->anggaran) }}
                    </td>
                    @for ($i = 1; $i <= $foreachCount; $i++)
                        @php
                            $target = $targetOpds->where('targetable_id', $opd->id)
                                ->when($periode == 'bulan', function ($query) use ($i) {
                                    return $query->where('bulan', $i);
                                })
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
                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($target) }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($realisasi) }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($persentase) }}
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
