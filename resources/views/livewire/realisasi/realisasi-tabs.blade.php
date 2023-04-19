<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Realisasi Anggaran
    </h2>
</x-slot>

<div class="pb-12">
    <div class="bg-white shadow-sm sm:rounded-lg">
        <div>
            @if (auth()->user()->isAdmin() || auth()->user()->isOpd())
                <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2 justify-end">
                    <div class="w-1/2 flex gap-2">
                        @if (auth()->user()->isAdmin())
                            <div class="w-full">
                                <x-native-select label="OPD" wire:model="opdPilihan">
                                    <option value="">Semua OPD</option>
                                    @foreach ($opds as $opd)
                                        <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        @endif

                        @if (auth()->user()->isAdmin() || auth()->user()->isOpd())
                            <div class="w-full">
                                <x-native-select label="Sub OPD" wire:model="subOpdPilihan">
                                    <option value="">Semua Sub OPD (Unit)</option>
                                    @foreach ($subOpds as $subOpd)
                                        <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                                    @endforeach
                                </x-native-select>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="p-6 text-gray-900">
            <div x-data="{ tab: @entangle('tabAktif') }">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="mr-2" role="presentation">
                            <button @click="tab = 'program'"
                                    :class="tab == 'program' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                    class="inline-block p-4 border-b-2 rounded-t-lg" id="program-tab"
                                    data-tabs-target="#program" type="button" role="tab"
                                    aria-selected="false">Program</button>
                        </li>

                        <li class="mr-2" role="presentation">
                            <button @click="tab = 'kegiatan'"
                                    :class="tab == 'kegiatan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                    class="inline-block p-4 border-b-2 rounded-t-lg" id="kegiatan-tab"
                                    data-tabs-target="#kegiatan" type="button" role="tab"
                                    aria-selected="false">Kegiatan</button>
                        </li>

                        <li class="mr-2" role="presentation">
                            <button @click="tab = 'subKegiatan'"
                                    :class="tab == 'subKegiatan' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                    class="inline-block p-4 border-b-2 rounded-t-lg" id="sub-kegiatan-tab"
                                    data-tabs-target="#subKegiatan" type="button" role="tab"
                                    aria-selected="false">Sub Kegiatan</button>
                        </li>

                        <li class="mr-2" role="presentation">
                            <button @click="tab = 'objekRealisasi'"
                                    :class="tab == 'objekRealisasi' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                                    class="inline-block p-4 border-b-2 rounded-t-lg" id="objek-realisasi-tab"
                                    data-tabs-target="#objek-realisasi" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Data APBD</button>
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
                    <div x-show="tab == 'program'" x-transition>
                        @livewire('program.program-table', ['menu' => 'realisasi', 'opdId' => $opdPilihan, 'subOpdId' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'kegiatan'" x-transition>
                        @livewire('kegiatan.kegiatan-table')
                    </div>
                    <div x-show="tab == 'subKegiatan'" x-transition>
                        @livewire('sub-kegiatan.sub-kegiatan-table')
                    </div>
                    <div x-show="tab == 'objekRealisasi'" x-transition>
                        @livewire('objek-realisasi.objek-realisasi-table', ['menu' => 'realisasi', 'opdId' => $opdPilihan, 'subOpdId' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'realisasi'" x-transition>
                        @livewire('realisasi.realisasi-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
