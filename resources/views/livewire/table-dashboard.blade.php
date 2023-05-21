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
            <x-table.tbody-dashboard :$opds :$targetOpds :$periode :$foreachCount />
        </tbody>
    </table>
</div>
