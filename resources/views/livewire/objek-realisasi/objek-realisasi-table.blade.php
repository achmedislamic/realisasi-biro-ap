<div>
    <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2 justify-end">
        @if (Auth::user()->role->role_name === 'admin')
        <div class="w-1/2 flex gap-2">
            <div class="w-full">
                <x-native-select label="OPD" wire:model="opdPilihan">
                    <option selected>Pilih OPD</option>
                    @foreach ($pods as $opd)
                    <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama}}</option>
                    @endforeach
                </x-native-select>
            </div>

            <div class="w-full">
                <x-native-select label="Sub OPD" wire:model="subOpdPilihan">
                    <option selected>Pilih Sub OPD (Unit)</option>
                    @foreach ($subOpds as $subOpd)
                    <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama}}</option>
                    @endforeach
                </x-native-select>
            </div>
        </div>
        @endif

        <div class="flex items-end">
            <x-button primary icon="filter" label="Filter" wire:click="render" />
        </div>
    </div>

    <div class="flex flex-col gap-y-4">

        <x-table.scrollable :model="$realisasiApbds" class="w-[2000px]">

            <x-slot name="table_actions">
                <x-button primary label="Tambah" :href="route('objek-realisasi.form')" />
                @if (Auth::user()->role->role_name === 'admin')
                <x-button positive label="Import Anggaran Realisasi" :href="route('objek-realisasi.import')" />
                @endif
            </x-slot>

            <x-table.thead>
                <tr>
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
                    <x-table.th class="w-36">
                        Aksi
                    </x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($realisasiApbds as $key => $objekRealisasi)
                <x-table.tr>
                    <x-table.td>
                        {{ $realisasiApbds->firstItem() + $key }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->subOpd->opd->kode." ".$objekRealisasi->subOpd->opd->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->subOpd->kode." ".$objekRealisasi->subOpd->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->subKegiatan->kode." ".$objekRealisasi->subKegiatan->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->subRincianObjekBelanja->kode."
                        ".$objekRealisasi->subRincianObjekBelanja->nama
                        }}
                    </x-table.td>
                    <x-table.td>
                        {{ number_format($objekRealisasi->anggaran, 2, ',', '.') }}
                    </x-table.td>
                    <x-table.td>
                        {{ number_format($objekRealisasi->realisasi->sum('realisasi'), 2, ',', '.') }}
                    </x-table.td>

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
                </x-table.tr>
                @endforeach
            </tbody>
        </x-table.scrollable>
    </div>
</div>
