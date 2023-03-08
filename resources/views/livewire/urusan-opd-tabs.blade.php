<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah - Urusan
    </h2>
</x-slot>

<x-container>
    <div x-data="{ tab: 'urusan' }">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li class="mr-2" role="presentation">
                    <button @click="tab = 'urusan'" :class="tab == 'urusan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''" class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Urusan</button>
                </li>
                <li @click="tab = 'bidang_urusan'" class="mr-2" role="presentation">
                    <button @click="tab = 'bidang_urusan'" :class="tab == 'bidang_urusan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''" class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Bidang Urusan</button>
                </li>
                <li @click="tab = 'opd'" class="mr-2" role="presentation">
                    <button @click="tab = 'opd'" :class="tab == 'opd' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''" class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Bidang Urusan</button>
                </li>
                <li @click="tab = 'sub_opd'" class="mr-2" role="presentation">
                    <button @click="tab = 'sub_opd'" :class="tab == 'sub_opd' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''" class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Bidang Urusan</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div x-show="tab == 'urusan'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                @livewire('urusan.urusan-table')
            </div>
            <div x-show="tab == 'bidang_urusan'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Bidang Urusan.</p>
            </div>
            <div x-show="tab == 'opd'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Opd.</p>
            </div>
            <div x-show="tab == 'sub_opd'" x-transition class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <p class="text-sm text-gray-500 dark:text-gray-400">Sub OPD.</p>
            </div>
        </div>
    </div>
</x-container>
