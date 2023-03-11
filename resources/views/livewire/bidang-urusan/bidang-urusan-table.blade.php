<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 pl-2 text-slate-900">
        <p class="pl-2">{{ $urusan->kode ?? "" }} {{ $urusan->nama ?? "" }}</p>
    </div>
    <hr>
    <x-table.index :model="$bidangUrusans">

        <x-slot name="table_actions">
            @if ($idUrusan != 0)
            <x-button primary label="Tambah" :href="route('bidang-urusan.form', $idUrusan)" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
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
            @foreach ($bidangUrusans as $bidangUrusan)
            <x-table.tr>
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