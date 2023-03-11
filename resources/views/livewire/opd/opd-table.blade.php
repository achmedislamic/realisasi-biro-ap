<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">{{ $bidangUrusan->urusan->kode ?? "" }} {{ $bidangUrusan->urusan->nama ?? "" }}</p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">{{ $bidangUrusan->kode ?? "" }} {{ $bidangUrusan->nama ?? "" }}</p>
        </div>
    </div>

    <hr>

    <x-table.index :model="$opds">

        <x-slot name="table_actions">
            @if ($idBidangUrusan != 0)
            <x-button primary label="Tambah" :href="route('opd.form', $idBidangUrusan)" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    OPD
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($opds as $opd)
            <x-table.tr>
                <x-table.td>
                    {{ $opd->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $opd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusOpd',
                                params: {{ $opd->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    <x-button.circle positive xs icon="folder-open" wire:click="pilihIdOpdEvent({{ $opd->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>