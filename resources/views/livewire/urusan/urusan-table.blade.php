<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah - Urusan
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$urusans">

        <x-slot name="table_actions">
            <x-button primary label="Tambah" :href="route('urusan.form')" />
        </x-slot>

        <x-table.thead>
            <tr>
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
                    <x-button.circle positive xs icon="folder-open" :href="route('bidang-urusan', $urusan->id)" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>