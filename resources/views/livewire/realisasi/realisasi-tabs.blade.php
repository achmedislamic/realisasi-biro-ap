<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Realisasi APBD
    </h2>
</x-slot>

<div x-data="{ pemberitahuan: true }" class="pb-12">
    <div class="bg-white shadow-sm sm:rounded-lg">
        <div>
            {{-- @if (auth()->user()->isAdminOrSektor() || auth()->user()->isOpd()) --}}
            @if (auth()->user()->isAdmin())
                <div class="mb-4 bg-slate-100 p-3 pt-0 rounded-md flex gap-2 justify-end">
                    <div class="w-1/2 flex gap-2">
                        {{-- @if (auth()->user()->isAdminOrSektor()) --}}
                        @if (auth()->user()->isAdmin())
                            <div class="w-full flex flex-row items-end space-x-3">
                                <div class="w-full">
                                    <x-native-select
                                        label="Bidang"
                                        placeholder="Semua Bidang"
                                        wire:model="bidangPilihan"
                                    >
                                    <option value="">Silakan Pilih</option>
                                    @foreach (\App\Models\Bidang::orderBy('nama')->get() as $bidang)
                                        <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                                    @endforeach
                                    </x-native-select>
                                </div>
                                <x-loading-indicator target="bidangPilihan" />
                            </div>
                        @endif

                        @if (auth()->user()->isAdmin())
                            <div class="w-full flex flex-row items-end space-x-3">
                                <div class="w-full">
                                    <x-native-select
                                        label="Sub OPD"
                                        placeholder="Semua Sub OPD (Unit)"
                                        wire:model="subOpdPilihan"
                                    >
                                    <option value="">Silakan Pilih</option>
                                    @foreach (\App\Models\SubOpd::orderBy('nama')->get() as $upt)
                                        <option value="{{ $upt->id }}">{{ $upt->nama }}</option>
                                    @endforeach
                                    </x-native-select>
                                </div>
                                <x-loading-indicator target="subOpdPilihan" />
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
                                    aria-selected="false">Rekening</button>
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
                        @livewire('program.program-table', ['menu' => 'realisasi', 'bidangId' => $bidangPilihan, 'subOpdPilihan' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'kegiatan'" x-transition>
                        @livewire('kegiatan.kegiatan-table', ['menu' => 'realisasi', 'programId' => $programId, 'bidangId' => $bidangPilihan, 'subOpdPilihan' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'subKegiatan'" x-transition>
                        @livewire('sub-kegiatan.sub-kegiatan-table', ['menu' => 'realisasi', 'programId' => $programId, 'kegiatanId' => $kegiatanId, 'bidangId' => $bidangPilihan, 'subOpdPilihan' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'objekRealisasi'" x-transition>
                        @livewire('objek-realisasi.objek-realisasi-table', ['menu' => 'realisasi', 'programId' => $programId, 'kegiatanId' => $kegiatanId, 'subKegiatanId' => $subKegiatanId, 'bidangId' => $bidangPilihan, 'subOpdPilihan' => $subOpdPilihan])
                    </div>
                    <div x-show="tab == 'realisasi'" x-transition>
                        @livewire('realisasi.realisasi-table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (filled($jadwal))
        <div x-show="pemberitahuan" x-transition class="fixed bottom-0 left-0 z-20 w-full p-2 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-4 dark:bg-gray-800 dark:border-gray-600">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                Jadwal input realisasi untuk bulan {{ $jadwal->bulan->translatedFormat('M Y') }} adalah hingga <span class="text-red-400">{{ \App\Helpers\FormatHelper::tanggal($jadwal->tanggal_waktu->timezone('Asia/Makassar'), true) }}</span>
            </span>
            <x-button xs @click="pemberitahuan = false" negative label="Saya mengerti, tutup pemberitahuan ini" />
        </div>
    @endif


</div>
