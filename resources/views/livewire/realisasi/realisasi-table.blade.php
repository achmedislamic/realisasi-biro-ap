<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Realisasi Belanja
    </h2>
</x-slot>

<div class="pb-12">
    <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2">
                <div class="w-1/2 flex gap-2">
                    <div class="w-1/2">
                        <x-datetime-picker label="Dari Tanggal" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD"
                            wire:model.defer="dariTanggal" without-time display-format="DD-MM-YYYY" />
                    </div>
                    <div class="w-1/2">
                        <x-datetime-picker label="Sampai Tanggal" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD"
                            wire:model.defer="sampaiTanggal" without-time display-format="DD-MM-YYYY" />
                    </div>
                </div>

                <div class="w-1/2">
                    <x-native-select wire:model.defer="idTahapanApbd" label="Tahapan APBD">
                        <option selected>Pilih tahapan APBD</option>
                        @foreach ($tahapanApbds as $tahapan)
                        <option value="{{ $tahapan->id }}">{{ $tahapan->tahun }} - {{ $tahapan->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="flex items-end">
                    <x-button primary icon="filter" label="Filter" wire:click="render" />
                </div>
            </div>

            <div class="flex flex-col gap-y-4">

                <x-table.scrollable :model="$realisasiApbds" class="w-[2000px]">

                    <x-slot name="table_actions">
                        <x-button primary label="Tambah" :href="route('realisasi.form')" />
                        <x-button positive label="Import Anggaran Realisasi" :href="route('realisasi.import')" />
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
                            <x-table.th class="w-28">
                                Aksi
                            </x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach ($realisasiApbds as $key => $realisasiApbd)
                        <x-table.tr>
                            <x-table.td>
                                {{ $realisasiApbds->firstItem() + $key }}
                            </x-table.td>
                            <x-table.td>
                                {{ $realisasiApbd->subOpd->opd->kode." ".$realisasiApbd->subOpd->opd->nama }}
                            </x-table.td>
                            <x-table.td>
                                {{ $realisasiApbd->subOpd->kode." ".$realisasiApbd->subOpd->nama }}
                            </x-table.td>
                            <x-table.td>
                                {{ $realisasiApbd->subKegiatan->kode." ".$realisasiApbd->subKegiatan->nama }}
                            </x-table.td>
                            <x-table.td>
                                {{ $realisasiApbd->subRincianObjekBelanja->kode."
                                ".$realisasiApbd->subRincianObjekBelanja->nama
                                }}
                            </x-table.td>
                            <x-table.td>
                                {{ number_format($realisasiApbd->anggaran, 2, ',', '.') }}
                            </x-table.td>
                            <x-table.td>
                                {{ number_format($realisasiApbd->realisasi, 2, ',', '.') }}
                            </x-table.td>

                            <x-table.td>
                                <x-button.circle warning xs icon="pencil"
                                    :href="route('realisasi.form', [$realisasiApbd->id])" />
                                <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data realisasi ini?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusRealisasiBelanja',
                                params: {{ $realisasiApbd->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                            </x-table.td>
                        </x-table.tr>
                        @endforeach
                    </tbody>
                </x-table.scrollable>
            </div>
        </div>
    </div>
</div>