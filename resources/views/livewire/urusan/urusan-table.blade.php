<x-table.index :model="$urusans">
    <x-slot name="table_actions">
        <x-button primary label="Tambah" :href="route('urusan.form')" />
    </x-slot>

    <x-table.thead>
        <tr>
            <x-table.th>
                Kode
            </x-table.th>
            <x-table.th>
                Urusan
            </x-table.th>
            <x-table.th>
                Aksi
            </x-table.th>
        </tr>
    </x-table.thead>
    <tbody>
        @foreach ($urusans as $urusan)
        <x-table.tr>
            <x-table.td>
                {{ $urusan->kode }}
            </x-table.td>
            <x-table.td>
                {{ $urusan->nama }}
            </x-table.td>
            <x-table.td>
                <x-button.circle warning xs icon="pencil" :href="route('urusan.form', $urusan->id)" />
                <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusUrusan',
                            params: {{ $urusan->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />
                <x-button.circle positive xs icon="folder-open" wire:click="pilihIdUrusanEvent({{ $urusan->id }})" />
            </x-table.td>
        </x-table.tr>
        @endforeach
    </tbody>
</x-table.index>