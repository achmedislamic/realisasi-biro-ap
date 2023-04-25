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
                <th {{ $periode == 'bulan' ? 'rowspan=3' : '' }} scope="col" class="px-6 py-3">
                    {{ auth()->user()->isOpd()? 'Sub ': '' }}OPD
                </th>
                <th {{ $periode == 'bulan' ? 'rowspan=3' : '' }} scope="col" class="px-6 py-3 text-right">
                    Anggaran
                </th>
                <th {{ $periode == 'bulan' ? 'colspan=36' : '' }} scope="col" class="px-6 py-3 text-center">
                    Realisasi
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Persentase
                </th>
            </tr>
            <tr>
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
            </tr>
            <tr>
                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>

                <th class="text-center">Target</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>
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
                    @for ($i = 1; $i <= 12; $i++)
                        {{-- target --}}
                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($targetBiros->where('bulan', $i)->where('targetable_id', $biro->id)->first()->jumlah ?? 0) }}
                        </td>

                        {{-- realisasi --}}
                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($biro->{'realisasi_' . $i} ?? 0) }}
                        </td>

                        {{-- persentase --}}
                        <td class="px-6 py-4 text-right">
                            {{ \App\Helpers\FormatHelper::angka($biro->realisasi / $biro->anggaran) }}
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
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($opd->realisasi) }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($opd->realisasi / $opd->anggaran) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
