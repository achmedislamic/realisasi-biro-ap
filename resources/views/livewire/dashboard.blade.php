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
                @php
                    $count = match ($periode) {
                        'bulan' => 12,
                        'triwulan' => 4,
                        'semester' => 2,
                        'tahun' => 1,
                    };
                @endphp
                @for ($i = 1; $i <= $count; $i++)
                    <th class="text-center">Target</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Persentase</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($biros as $biro)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $biro->nama_sub_opd }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($biro->anggaran) }}
                    </td>

                    {{-- dapatkan target, jumlah realisasi, persentase --}}
                    @for ($i = 1; $i <= $count; $i++)
                        @php
                            $target = $targetBiros
                                ->where('targetable_id', $biro->id)
                                ->when($periode == 'bulan', function ($query) use ($i) {
                                    $query->where('bulan', $i);
                                })
                                ->when($periode == 'triwulan', function ($query) use ($i) {
                                    if($i == 1){
                                        $query->whereIn('bulan', [1,2,3]);
                                    }

                                    if($i == 2){
                                        $query->whereIn('bulan', [4,5,6]);
                                    }

                                    if($i == 3){
                                        $query->whereIn('bulan', [7,8,9]);
                                    }

                                    if($i == 4){
                                        $query->whereIn('bulan', [10,11,12]);
                                    }
                                });

                            if($periode == 'bulan'){
                                $target = $target->first()->jumlah ?? 0;
                            } else {
                                $target = $target->sum('jumlah') ?? 0;
                            }
                            $realisasi = match($periode) {
                                'bulan' => $biro->{'realisasi_' . $i} ?? 0,
                                'triwulan' => $biro->{'realisasi_triwulan_' . $i} ?? 0,
                                'semester' => $biro->{'realisasi_semester' . $i} ?? 0,
                                'tahun' => $biro->realisasi ?? 0,
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

            @foreach ($opds as $opd)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $opd->nama_opd ?? $opd->nama_sub_opd }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($opd->anggaran) }}
                    </td>
                    @for ($i = 1; $i <= $count; $i++)
                        @php
                            $target =
                                $targetOpds
                                    ->where('bulan', $i)
                                    ->where('targetable_id', $opd->id)
                                    ->first()->jumlah ?? 0;
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
