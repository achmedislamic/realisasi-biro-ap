<div>
    @if (auth()->user()->isAdmin() || auth()->user()->isOpd())
    <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2 justify-end">
        <div class="w-1/2 flex gap-2">
            @if (auth()->user()->isAdmin())
                <div class="w-full">
                    <x-native-select label="OPD" wire:model="opdPilihan">
                        <option value="">Pilih OPD</option>
                        @foreach ($pods as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endif


            @if (auth()->user()->isAdmin() || auth()->user()->isOpd())
                <div class="w-full">
                    <x-native-select label="Sub OPD" wire:model="subOpdPilihan">
                        <option value="">Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                        <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endif
        </div>
    </div>
    @endif


    <div class="flex flex-col gap-y-4">

        <x-table.scrollable :model="$realisasiApbds" class="w-[2000px]">

            <x-slot name="table_actions">
                <x-button primary label="Tambah" :href="route('objek-realisasi.form')" />
                @if (auth()->user()->isAdmin())
                <x-button positive label="Import Anggaran Realisasi" :href="route('objek-realisasi.import')" />
                @endif
            </x-slot>

            <x-table.thead>
                <tr>
                    <x-table.th class="w-36">
                        Aksi
                    </x-table.th>
                    <x-table.th>
                        #
                    </x-table.th>
                    <x-table.th>
                        Opd
                    </x-table.th>
                    <x-table.th>
                        Sub Opd
                    </x-table.th>
                    <x-table.th>
                        Sub Kegiatan
                    </x-table.th>
                    <x-table.th>
                        Rekening Belanja
                    </x-table.th>
                    <x-table.th>
                        Anggaran
                    </x-table.th>
                    <x-table.th>
                        Realisasi
                    </x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($realisasiApbds as $key => $objekRealisasi)
                <x-table.tr>
                    <x-table.td>
                        <x-button.circle warning xs icon="pencil"
                            :href="route('objek-realisasi.form', [$objekRealisasi->id])" />
                        <x-button.circle negative xs icon="trash" x-on:confirm="{
                                title: 'Anda yakin akan menghapus data objek realisasi ini?',
                                icon: 'question',
                                accept: {
                                    label: 'Hapus',
                                    method: 'hapusObjekRealisasiBelanja',
                                    params: {{ $objekRealisasi->id }}
                                },
                                reject: {
                                    label: 'Batal'
                                }
                            }" />
                        <x-button.circle positive xs icon="folder-open"
                            wire:click="pilihIdObjekRealisasiEvent({{ $objekRealisasi->id }})" />
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbds->firstItem() + $key }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->kode_opd." ".$objekRealisasi->kode_sub_opd }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->kode_sub_opd." ".$objekRealisasi->nama_sub_opd }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->subKegiatan->kode." ".$objekRealisasi->subKegiatan->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->kode_sub_rincian_objek_belanja."
                        ".$objekRealisasi->nama_sub_rincian_objek_belanja
                        }}
                    </x-table.td>
                    <x-table.td>
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->anggaran) }}
                    </x-table.td>
                    <x-table.td>
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->realisasis->sum('jumlah')) }}
                    </x-table.td>
                </x-table.tr>
                @endforeach
            </tbody>
        </x-table.scrollable>
    </div>
</div>
