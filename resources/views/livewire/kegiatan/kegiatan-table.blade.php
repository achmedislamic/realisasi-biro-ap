<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $program->kode ?? "" }} {{ $program->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$kegiatans">

        <x-slot name="table_actions">
            @if ($idProgram != 0)
            <x-button primary :href="route('kegiatan.form', $idProgram)" label="Tambah" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
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
            @foreach ($kegiatans as $key => $kegiatan)
            <x-table.tr>
                <x-table.td>
                    {{ $kegiatans->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $kegiatan->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $kegiatan->nama }}
                </x-table.td>
                <x-table.td>
                    @if ($menu != 'realisasi')
                    <x-button.circle warning xs icon="pencil"
                            :href="route('kegiatan.form', [$idProgram, $kegiatan->id])" />
                        <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusKegiatan',
                                params: {{ $kegiatan->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    @endif

                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdKegiatanEvent({{ $kegiatan->id }}, '{{ $menu }}', '{{ $opdId }}', '{{ $subOpdId }}')" />
                </x-table.td>

            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
