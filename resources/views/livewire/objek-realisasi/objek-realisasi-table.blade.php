<div>
    <div class="flex flex-col gap-y-4">
        <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $subOpd->opd->kode ?? "" }} {{ $subOpd->opd->nama ?? "" }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $subOpd->kode ?? "" }} {{ $subOpd->nama ?? "" }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $subKegiatan->kegiatan->program->kode ?? "" }} {{ $subKegiatan->kegiatan->program->nama ?? "" }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-4 h-0.5"></div>
                <p>{{ $subKegiatan->kegiatan->kode ?? "" }} {{ $subKegiatan->kegiatan->nama ?? "" }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-4 h-0.5"></div>
                <p>{{ $subKegiatan->kode ?? "" }} {{ $subKegiatan->nama ?? "" }}</p>
            </div>
        </div>
        <x-table.scrollable :model="$realisasiApbds" class="w-[2000px]">

            <x-slot name="table_actions">
                @if (auth()->user()->isAdmin())
                    <x-button
                        primary
                        label="Tambah"
                        :href="route('objek-realisasi.form', [
                            'opdPilihan' => $subOpd?->opd_id,
                            'subOpdPilihan' => $subOpd?->id,
                            'programPilihan' => $subKegiatan?->kegiatan?->program_id,
                            'kegiatanPilihan' => $subKegiatan?->kegiatan_id,
                            'subKegiatanPilihan' => $subKegiatan?->id
                        ])" />
                    <x-button positive label="Import Anggaran Realisasi" :href="route('objek-realisasi.import')" />
                @endif
            </x-slot>

            <x-table.thead>
                <tr>
                    <x-table.th>
                        #
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
                    <x-table.th>
                        Target
                    </x-table.th>
                    <x-table.th>
                        Satuan
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
                    <x-table.td wire:click="pilihIdObjekRealisasiEvent({{ $objekRealisasi->id }})" class="hover:underline hover:text-blue-500 hover:cursor-pointer">
                        {{ $objekRealisasi->subRincianObjekBelanja->rincianObjekBelanja->kode . ' ' .$objekRealisasi->subRincianObjekBelanja->kode.".".$objekRealisasi->subRincianObjekBelanja->nama
                        }}
                        <x-loading-indicator target="pilihIdObjekRealisasiEvent({{ $objekRealisasi->id }})" class="hover:underline hover:text-blue-500 hover:cursor-pointer" />
                    </x-table.td>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->anggaran) }}
                    </x-table.td>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->realisasis->sum('jumlah')) }}
                    </x-table.td>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->target) }}
                    </x-table.td>
                    <x-table.td>
                        {{ $objekRealisasi->nama_satuan }}
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
