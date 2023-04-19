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
                        {{ $objekRealisasi->subRincianObjekBelanja->rincianObjekBelanja->kode . ' ' .$objekRealisasi->subRincianObjekBelanja->kode.".".$objekRealisasi->subRincianObjekBelanja->nama
                        }}
                    </x-table.td>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->anggaran) }}
                    </x-table.td>
                    <x-table.td class="text-right">
                        {{ \App\Helpers\FormatHelper::angka($objekRealisasi->realisasis->sum('jumlah')) }}
                    </x-table.td>
                </x-table.tr>
                @endforeach
            </tbody>
        </x-table.scrollable>
    </div>
</div>
