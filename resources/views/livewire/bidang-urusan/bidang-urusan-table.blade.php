<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $urusan->kode ?? "" }} {{ $urusan->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$bidangUrusans">

        <x-slot name="table_actions">
            @if ($idUrusan != 0)
            <x-button primary label="Tambah" :href="route('bidang-urusan.form', $idUrusan)" />
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
                    Bidang Urusan
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
                    {{ $bidangUrusans->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $bidangUrusan->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $bidangUrusan->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('bidang-urusan.form', [$bidangUrusan->urusan->id, $bidangUrusan->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                                title: 'Anda yakin akan menghapus data?',
                                icon: 'question',
                                accept: {
                                    label: 'Hapus',
                                    method: 'hapusBidangUrusan',
                                    params: {{ $bidangUrusan->id }}
                                },
                                reject: {
                                    label: 'Batal'
                                }
                            }" />

                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdBidangUrusanEvent({{ $bidangUrusan->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
