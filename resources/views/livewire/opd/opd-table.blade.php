<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $bidangUrusan->urusan->kode ?? "" }} {{ $bidangUrusan->urusan->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $bidangUrusan->kode ?? "" }} {{ $bidangUrusan->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$bidangUrusans">

        <x-slot name="table_actions">
            @if ($idBidangUrusan != 0)
            <x-button primary label="Tambah" :href="route('opd.form', $idBidangUrusan)" />
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
                    OPD
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($bidangUrusans as $key => $bidangUrusan)
            <x-table.tr>
                <x-table.td>
                    {{ $loop->iteration }}
                </x-table.td>
                <x-table.td>
                    {{ $bidangUrusan->opd->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $bidangUrusan->opd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil" :href="route('opd.form', [$idBidangUrusan, $bidangUrusan->opd->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusOpd',
                                params: {{ $bidangUrusan->opd->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    <x-button.circle positive xs icon="folder-open" wire:click="pilihIdOpdEvent({{ $bidangUrusan->opd->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
