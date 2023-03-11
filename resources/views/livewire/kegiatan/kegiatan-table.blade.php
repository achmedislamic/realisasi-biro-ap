<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">{{ $program->kode ?? "" }} {{ $program->nama ?? "" }}</p>
    </div>

    <hr>

    <x-table.index :model="$kegiatans">

        <x-slot name="table_actions">
            @if ($idProgram != 0)
            <x-button primary :href="route('kegiatan.form', $idProgram)" label="Tambah" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
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
            @foreach ($kegiatans as $kegiatan)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $kegiatan->kode }}
                </x-table.td-utama>
                <x-table.td-utama>
                    {{ $kegiatan->nama }}
                </x-table.td-utama>
                <x-table.td>
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
                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdKegiatanEvent({{ $kegiatan->id }})" />
                </x-table.td>

            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>