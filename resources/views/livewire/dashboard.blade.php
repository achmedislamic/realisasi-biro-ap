<div wire:poll class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-3">
    Waktu saat ini: {{ now() }}
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ auth()->user()->isOpd() ? 'Sub ' : '' }}OPD
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Anggaran
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Realisasi
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Persentase
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($biros as $biro)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $biro->nama_sub_opd }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{\App\Helpers\FormatHelper::angka($biro->anggaran) }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($biro->realisasi) }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        {{ \App\Helpers\FormatHelper::angka($biro->realisasi / $biro->anggaran) }}
                    </td>
                </tr>
            @endforeach

            @foreach ($opds as $opd)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $opd->nama_opd ?? $opd->nama_sub_opd }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{\App\Helpers\FormatHelper::angka($opd->anggaran) }}
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
