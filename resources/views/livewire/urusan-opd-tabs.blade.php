<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah
    </h2>
</x-slot>

<x-container>
    <div x-data="{ tab: @entangle('tabAktif') }">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                @if ($mode != 'opd')
                    <li class="mr-2" role="presentation">
                        <button @click="tab = 'urusan'"
                                :class="tab == 'urusan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Urusan</button>
                    </li>
                    <li @click="tab = 'bidang_urusan'" class="mr-2" role="presentation">
                        <button @click="tab = 'bidang_urusan'"
                                :class="tab == 'bidang_urusan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Bidang Urusan</button>
                    </li>
                @endif

                <li @click="tab = 'opd'" class="mr-2" role="presentation">
                    <button @click="tab = 'opd'"
                            :class="tab == 'opd' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                            class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">OPD</button>
                </li>
                <li @click="tab = 'sub_opd'" class="mr-2" role="presentation">
                    <button @click="tab = 'sub_opd'"
                            :class="tab == 'sub_opd' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                            class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Sub OPD</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            @if ($mode != 'opd')
                <div x-show="tab == 'urusan'" x-transition>
                    @livewire('urusan.urusan-table')
                </div>
                <div x-show="tab == 'bidang_urusan'" x-transition>
                    @livewire('bidang-urusan.bidang-urusan-table')
                </div>
            @endif
            <div x-show="tab == 'opd'" x-transition>
                @livewire('opd.opd-table')
            </div>
            <div x-show="tab == 'sub_opd'" x-transition>
                @livewire('sub-opd.sub-opd-table')
            </div>
        </div>
    </div>
</x-container>
