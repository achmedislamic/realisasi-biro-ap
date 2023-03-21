<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Rekening Belanja
    </h2>
</x-slot>

<x-container>
    <div x-data="{ tab: @entangle('rekeningTabAktif') }">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li class="mr-2" role="presentation">
                    <button @click="tab = 'akun'"
                        :class="tab == 'akun' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="akun-tab" data-tabs-target="#akun"
                        type="button" role="tab" aria-controls="akun" aria-selected="false">Akun</button>
                </li>
                <li @click="tab = 'kelompok'" class="mr-2" role="presentation">
                    <button @click="tab = 'kelompok'"
                        :class="tab == 'kelompok' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="kelompok-tab" data-tabs-target="#kelompok"
                        type="button" role="tab" aria-controls="kelompok" aria-selected="false">Kelompok</button>
                </li>
                <li @click="tab = 'jenis'" class="mr-2" role="presentation">
                    <button @click="tab = 'jenis'"
                        :class="tab == 'jenis' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="jenis-tab" data-tabs-target="#jenis"
                        type="button" role="tab" aria-controls="jenis" aria-selected="false">Jenis</button>
                </li>
                <li @click="tab = 'objek'" class="mr-2" role="presentation">
                    <button @click="tab = 'objek'"
                        :class="tab == 'objek' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="objek-tab" data-tabs-target="#objek"
                        type="button" role="tab" aria-controls="objek" aria-selected="false">Objek</button>
                </li>
                <li @click="tab = 'rincian_objek'" class="mr-2" role="presentation">
                    <button @click="tab = 'rincian_objek'"
                        :class="tab == 'rincian_objek' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="rincian_objek-tab"
                        data-tabs-target="#rincian_objek" type="button" role="tab" aria-controls="rincian_objek"
                        aria-selected="false">Rincian Objek</button>
                </li>
                <li @click="tab = 'sub_rincian_objek'" class="mr-2" role="presentation">
                    <button @click="tab = 'sub_rincian_objek'"
                        :class="tab == 'sub_rincian_objek' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                        class="inline-block p-4 border-b-2 rounded-t-lg" id="sub_rincian_objek-tab"
                        data-tabs-target="#sub_rincian_objek" type="button" role="tab" aria-controls="sub_rincian_objek"
                        aria-selected="false">Rekening (Sub Rincian Objek)</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div x-show="tab == 'akun'" x-transition>
                @livewire('akun-belanja.akun-belanja-table')
            </div>
            <div x-show="tab == 'kelompok'" x-transition>
                @livewire('kelompok-belanja.kelompok-belanja-table')
            </div>
            <div x-show="tab == 'jenis'" x-transition>
                @livewire('jenis-belanja.jenis-belanja-table')
            </div>
            <div x-show="tab == 'objek'" x-transition>
                @livewire('objek-belanja.objek-belanja-table')
            </div>
            <div x-show="tab == 'rincian_objek'" x-transition>
                @livewire('rincian-objek-belanja.rincian-objek-belanja-table')
            </div>
            <div x-show="tab == 'sub_rincian_objek'" x-transition>
                @livewire('sub-rincian-objek-belanja.sub-rincian-objek-belanja-table')
            </div>
        </div>
    </div>
</x-container>