<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $kegiatan->program->kode ?? '' }} {{ $kegiatan->program->nama ?? '' }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $kegiatan->kode ?? '' }} {{ $kegiatan->nama ?? '' }}</p>
        </div>
    </div>

    <x-table.index :model="$subKegiatans">

        <x-slot name="table_actions">
            @if ($kegiatanId != 0)
                <x-button primary :href="route('sub-kegiatan.form', $kegiatanId)" label="Tambah" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
                @if (filled($menu) && config('app.mode') != 'pupr')
                    <x-table.th>Nama OPD</x-table.th>
                @endif
                @if (!auth()->user()->isSubOpd())
                    <x-table.th>Nama UPT</x-table.th>
                @endif

                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subKegiatans as $key => $subKegiatan)
                <x-table.tr>
                    <x-table.td>
                        {{ $subKegiatans->firstItem() + $key }}
                    </x-table.td>
                    @if (filled($menu) && config('app.mode') != 'pupr')
                        <x-table.td>{{ $subKegiatan->kode_opd . ' ' . $subKegiatan->nama_opd }}</x-table.td>
                    @endif
                    @if (!auth()->user()->isSubOpd())
                        <x-table.td>{{ $subKegiatan->kode_sub_opd . ' ' . $subKegiatan->nama_sub_opd }}</x-table.td>
                    @endif

                    <x-table.td>
                        {{ $subKegiatan->kode }}
                    </x-table.td>
                    @if (filled($menu))
                        <x-table.td
                                    wire:click="$emit('subKegiatanClicked', '{{ $kegiatan->id }}', '{{ $menu }}', '{{ $subKegiatan?->opd_id }}', '{{ $subKegiatan->sub_opd_id }}')"
                                    class="hover:underline hover:cursor-pointer hover:text-yellow-500">
                            {{ $subKegiatan->nama }}
                            <x-loading-indicator />
                        </x-table.td>
                    @else
                        <x-table.td>{{ $subKegiatan->nama }}</x-table.td>
                    @endif

                    <x-table.td>
                        @if ($menu != 'realisasi')
                            <x-button.circle spinner warning xs icon="pencil"
                                             :href="route('sub-kegiatan.form', [$kegiatanId, $subKegiatan->id])" />
                            <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusSubKegiatan',
                            params: {{ $subKegiatan->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />
                        @endif
                        @if ($menu == 'realisasi')
                            <div class="flex flex-row space-x-3">
                                @if (config('app.mode') != 'pupr')
                                    <x-button orange xs icon="document" label="Isi Rincian Masalah"
                                              href="{{ route('rincian-masalah.form', ['subKegiatan' => $subKegiatan->id, 'subOpd' => $subKegiatan->sub_opd_id]) }}" />
                                @endif

                                <x-button.circle spinner positive xs icon="folder-open"
                                                 wire:click="$emit('subKegiatanClicked', '{{ $kegiatan->id }}', '{{ $menu }}', '{{ $subKegiatan->opd_id }}', '{{ $subKegiatan->sub_opd_id }}')" />
                            </div>
                        @endif
                    </x-table.td>

                </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
