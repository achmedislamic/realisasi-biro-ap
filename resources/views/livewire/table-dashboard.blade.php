<div wire:poll.10s class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-3 flex flex-col space-y-3">
    <div class="flex flex-col">
        <h2 class="text-center font-bold text-xl">Laporan Anggaran dan Realisasi Tiap OPD/UPT/Biro</h2>
        <small class="text-center text-xs">Tersinkron setiap 10 Detik</small>
    </div>
    <div>
        <span class="font-bold">Terakhir data disinkron:</span> {{ \App\Helpers\FormatHelper::tanggal(now(), true) }}
    </div>
    <div class="flex flex-row space-x-3">
        @if (! auth()->user()->isSubOpd())
            <div class="w-full flex flex-col align-center">
                <div class="flex flex-row space-x-2">
                    <div class="w-16 h-8 bg-red-500"></div>
                    <p>Realisasi < 40%</p>
                </div>

                <div class="flex flex-row space-x-2">
                    <div class="w-16 h-8 bg-yellow-500"></div>
                    <p>Realisasi 41% - 70%</p>
                </div>

                <div class="flex flex-row space-x-2 mb-3">
                    <div class="w-16 h-8 bg-green-500"></div>
                    <p>Realisasi 71% - 100%</p>
                </div>
            </div>
        @endif

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

    <div>
        <x-native-select label="Data Yang Terlihat" wire:model="dataType">
            <option value="sub_opd" selected>Sub OPD</option>
            <option value="bidang">Bidang</option>
        </x-native-select>
    </div>

    <div class="relative overflow-x-auto shadow-md rounded-md sm:rounded-lg border border-utama">
        <table class="border-collapse w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <x-dashboard.thead :$colspanRealisasi :$periode :$foreachCount :denganTarget="! auth()->user()->isSubOpd()" />
            <tbody>
                <x-table.tbody-dashboard :$opds :$targetOpds :$periode :$foreachCount :denganTarget="! auth()->user()->isSubOpd()" />
            </tbody>
        </table>
    </div>

</div>
