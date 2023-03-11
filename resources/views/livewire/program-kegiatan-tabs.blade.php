<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Program Kegiatan
    </h2>
</x-slot>

<x-container>
    <div x-data="{ tab: @entangle('proKegTabAktif') }">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li class="mr-2" role="presentation">
                    <button @click="tab = 'program'"
                        :class="tab == 'program' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="program-tab" data-tabs-target="#program"
                        type="button" role="tab" aria-controls="program" aria-selected="false">Program</button>
                </li>
                <li @click="tab = 'kegiatan'" class="mr-2" role="presentation">
                    <button @click="tab = 'kegiatan'"
                        :class="tab == 'kegiatan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="kegiatan-tab" data-tabs-target="#kegiatan"
                        type="button" role="tab" aria-controls="kegiatan" aria-selected="false">Kegiatan</button>
                </li>
                <li @click="tab = 'sub_kegiatan'" class="mr-2" role="presentation">
                    <button @click="tab = 'sub_kegiatan'"
                        :class="tab == 'sub_kegiatan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="program-kegiatan-tab"
                        data-tabs-target="#program-kegiatan" type="button" role="tab" aria-controls="program-kegiatan"
                        aria-selected="false">Sub Kegiatan</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div x-show="tab == 'program'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                @livewire('program.program-table')
            </div>
            <div x-show="tab == 'kegiatan'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                @livewire('kegiatan.kegiatan-table')
            </div>
            <div x-show="tab == 'sub_kegiatan'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                @livewire('sub-kegiatan.sub-kegiatan-table')
            </div>
        </div>
    </div>
</x-container>