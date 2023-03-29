<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Realisasi Anggaran
    </h2>
</x-slot>

<div class="pb-12">
    <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div x-data="{ tab: @entangle('tabAktif') }">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="mr-2" role="presentation">
                            <button @click="tab = 'objekRealisasi'"
                                :class="tab == 'objekRealisasi' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                class="inline-block p-4 border-b-2 rounded-t-lg" id="objek-realisasi-tab"
                                data-tabs-target="#objek-realisasi" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Objek Realisasi</button>
                        </li>
                        <li @click="tab = 'realisasi'" class="mr-2" role="presentation">
                            <button @click="tab = 'realisasi'"
                                :class="tab == 'realisasi' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                class="inline-block p-4 border-b-2 rounded-t-lg" id="realisasi-tab"
                                data-tabs-target="#realisasi" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Realisasi</button>
                        </li>
                    </ul>
                </div>
                <div id="myTabContent">
                    <div x-show="tab == 'objekRealisasi'" x-transition>
                        @livewire('objek-realisasi.objek-realisasi-table')
                    </div>
                    <div x-show="tab == 'realisasi'" x-transition>
                        @livewire('realisasi.realisasi-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
